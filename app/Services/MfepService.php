<?php

namespace App\Services;

use App\Models\EvaluasiSiswa;
use App\Models\HasilKeputusan;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Perhitungan;
use App\Models\MasterRekomendasi;
use App\Models\Rekomendasi;

class MfepService
{
    public function generatePenilaian(int $idPeriode, ?int $idKelas = null): void
    {
        $query = EvaluasiSiswa::where('id_periode', $idPeriode);

        if ($idKelas) {
            $query->where('id_kelas', $idKelas);
        }

        $evaluasis = $query->get();

        foreach ($evaluasis as $evaluasi) {
            $this->simpanPenilaian(
                $evaluasi,
                'Nilai Rata Rata Akademik',
                $this->mapNilaiAkademik($evaluasi->nilai_rata_rata),
                $idPeriode
            );

            $this->simpanPenilaian(
                $evaluasi,
                'Ketidak hadiran',
                $this->mapKehadiran($evaluasi->total_ketidakhadiran),
                $idPeriode
            );

            $this->simpanPenilaian(
                $evaluasi,
                'Pekerjaan orang tua',
                $this->mapPekerjaanOrtu($evaluasi->pekerjaan_ortu),
                $idPeriode
            );

            $this->simpanPenilaian(
                $evaluasi,
                'Pendidikan Orang Tua',
                $this->mapPendidikanOrtu($evaluasi->pendidikan_ortu),
                $idPeriode
            );
        }
    }

    public function hitungMfep(int $idPeriode, ?int $idKelas = null): void
{
    $query = Penilaian::with(['kriteria', 'siswa'])
        ->where('id_periode', $idPeriode);

    if ($idKelas) {
        $query->whereHas('siswa', function ($q) use ($idKelas) {
            $q->where('id_kelas', $idKelas);
        });
    }

    $penilaians = $query->get()->groupBy('id_siswa');

    $hasilSementara = [];

    foreach ($penilaians as $idSiswa => $items) {
        $totalPreferensi = 0;
        $faktorDominan = null;
        $nilaiDominan = -1;

        foreach ($items as $item) {
            if (!$item->kriteria) {
                continue;
            }

            $bobot = (float) $item->kriteria->bobot;
            $nilaiSkala = (int) $item->nilai_penilaian;

            // EF = X / Xmax
            $evaluationFactor = $nilaiSkala / 5;

            // WE = FW * E
            $hasilPerkalian = $bobot * $evaluationFactor;

            Perhitungan::updateOrCreate(
                [
                    'id_siswa' => $item->id_siswa,
                    'id_kriteria' => $item->id_kriteria,
                    'id_periode' => $item->id_periode,
                ],
                [
                    'nilai_bobot' => $bobot,
                    'nilai_skala' => $nilaiSkala,
                    'hasil_perkalian' => round($hasilPerkalian, 4),
                ]
            );

            $totalPreferensi += $hasilPerkalian;

            if ($hasilPerkalian > $nilaiDominan) {
                $nilaiDominan = $hasilPerkalian;
                $faktorDominan = $item->kriteria->nama_kriteria;
            }
        }

        $hasilSementara[] = [
            'id_siswa' => $idSiswa,
            'id_periode' => $idPeriode,
            'total_nilai_preferensi' => round($totalPreferensi, 4),
            'faktor_dominan' => $faktorDominan,
        ];
    }

    if (count($hasilSementara) === 0) {
        return;
    }

    $semuaNilai = collect($hasilSementara)
        ->pluck('total_nilai_preferensi')
        ->sort()
        ->values()
        ->toArray();

    $q1 = $this->quartileExc($semuaNilai, 0.25);
    $q3 = $this->quartileExc($semuaNilai, 0.75);

    foreach ($hasilSementara as $hasil) {
        $kategori = $this->kategoriRisikoQuartile(
            $hasil['total_nilai_preferensi'],
            $q1,
            $q3
        );

        $hasilModel = HasilKeputusan::updateOrCreate(
            [
                'id_siswa' => $hasil['id_siswa'],
                'id_periode' => $hasil['id_periode'],
            ],
            [
                'total_nilai_preferensi' => $hasil['total_nilai_preferensi'],
                'kategori_risiko' => $kategori,
                'faktor_dominan' => $hasil['faktor_dominan'],
                'tanggal_proses' => now(),
            ]
        );

        // Ambil dari master_rekomendasi
        $masterList = MasterRekomendasi::where('kategori_risiko', $kategori)
            ->where('faktor_dominan', $hasil['faktor_dominan'])
            ->where('is_active', 1)
            ->get();

        // Ambil deskripsi rekomendasi yang sudah ada di DB
        $rekomendasiSudahAda = Rekomendasi::where('id_hasil', $hasilModel->id_hasil)
            ->pluck('deskripsi_rekomendasi')
            ->toArray();

        // Tentukan mana yang selected saat ini
        $rekomendasiSelected = Rekomendasi::where('id_hasil', $hasilModel->id_hasil)
            ->where('is_selected', 1)
            ->first();

        $deskripsiSelected = $rekomendasiSelected?->deskripsi_rekomendasi
            ?? $hasilModel->tindak_lanjut_final;

        // Hapus rekomendasi lama yang sudah tidak ada di master (kecuali yang dipilih)
        $deskripsiMaster = $masterList->pluck('deskripsi_rekomendasi')->toArray();
        Rekomendasi::where('id_hasil', $hasilModel->id_hasil)
            ->whereNotIn('deskripsi_rekomendasi', $deskripsiMaster)
            ->where('is_selected', 0)
            ->delete();

        foreach ($masterList as $master) {
    if (!in_array($master->deskripsi_rekomendasi, $rekomendasiSudahAda)) {
        Rekomendasi::create([
            'id_hasil' => $hasilModel->id_hasil,
            'id_master_rekomendasi' => $master->id_master_rekomendasi,
            'deskripsi_rekomendasi' => $master->deskripsi_rekomendasi,
            'status' => 'belum_diproses',
            'tanggal_dibuat' => now(),
        ]);
    }
}

        // Pastikan is_selected tetap terjaga sesuai tindak_lanjut_final
        if ($deskripsiSelected) {
            Rekomendasi::where('id_hasil', $hasilModel->id_hasil)
                ->update(['is_selected' => 0]);

            Rekomendasi::where('id_hasil', $hasilModel->id_hasil)
                ->where('deskripsi_rekomendasi', $deskripsiSelected)
                ->update(['is_selected' => 1]);
        }
    }
}

    private function simpanPenilaian($evaluasi, string $namaKriteria, int $nilaiSkala, int $idPeriode): void
    {
        $kriteria = Kriteria::where('nama_kriteria', $namaKriteria)->first();

        if (!$kriteria) {
            return;
        }

        Penilaian::updateOrCreate(
            [
                'id_siswa' => $evaluasi->id_siswa,
                'id_kriteria' => $kriteria->id_kriteria,
                'id_periode' => $idPeriode,
            ],
            [
                'nilai_penilaian' => $nilaiSkala,
            ]
        );
    }

    // Sesuai tabel manual:
    // >=85 = 5, 75-84 = 4, 65-74 = 3, 56-64 = 2, <=55 = 1
    private function mapNilaiAkademik($nilai): int
    {
        if ($nilai === null) {
            return 0;
        }

        $nilai = (float) $nilai;

        if ($nilai >= 85) return 5;
        if ($nilai >= 75) return 4;
        if ($nilai >= 65) return 3;
        if ($nilai >= 56) return 2;
        return 1;
    }

    // Sesuai tabel manual:
    // 0-3 = 5, 4-7 = 4, 8-12 = 3, 13-18 = 2, >18 = 1
    private function mapKehadiran($totalKetidakhadiran): int
    {
        if ($totalKetidakhadiran === null) {
            return 0;
        }

        $totalKetidakhadiran = (int) $totalKetidakhadiran;

        if ($totalKetidakhadiran <= 3) return 5;
        if ($totalKetidakhadiran <= 7) return 4;
        if ($totalKetidakhadiran <= 12) return 3;
        if ($totalKetidakhadiran <= 18) return 2;
        return 1;
    }

    // Disesuaikan dengan kategori pekerjaan manual
    private function mapPekerjaanOrtu(?string $pekerjaan): int
    {
        if (!$pekerjaan) {
            return 0;
        }

        $pekerjaan = strtoupper(trim($pekerjaan));

        // skor 5
        if (in_array($pekerjaan, [
            'ASN',
            'PNS'
        ])) {
            return 5;
        }

        // skor 4
        if (in_array($pekerjaan, [
            'PENJAGA SEKOLAH',
            'SATPAM',
            'KARYAWAN TIDAK TETAP',
            'PEKERJAAN FORMAL',
            'FORMAL',
            'ASN/PEKERJAAN FORMAL',
            'ASN/FORMAL'
        ])) {
            return 4;
        }

        // skor 3
        if (in_array($pekerjaan, [
            'PEDAGANG',
            'PETANI',
            'TANI',
            'PEKERJAAN INFORMAL MENENGAH',
            'INFORMAL MENENGAH'
        ])) {
            return 3;
        }

        // skor 2
        if (in_array($pekerjaan, [
            'BURUH HARIAN',
            'BURUH LEPAS',
            'NELAYAN',
            'SOPIR',
            'PEKERJAAN INFORMAL RENDAH',
            'INFORMAL RENDAH'
        ])) {
            return 2;
        }

        // skor 1
        if (in_array($pekerjaan, [
            'TIDAK BEKERJA',
            'BELUM/TIDAK BEKERJA'
        ])) {
            return 1;
        }

        return 1;
    }

    // Sesuai tabel manual:
    // Sarjana=5, SMA=4, SMP/SLTP=3, SD=2, Tidak Sekolah=1
    private function mapPendidikanOrtu(?string $pendidikan): int
    {
        if (!$pendidikan) {
            return 0;
        }

        $pendidikan = strtoupper(trim($pendidikan));

        if (in_array($pendidikan, ['SARJANA', 'S1', 'S2', 'S3'])) {
            return 5;
        }

        if (in_array($pendidikan, ['SMA', 'SLTA', 'SMK', 'MA'])) {
            return 4;
        }

        if (in_array($pendidikan, ['SMP', 'SLTP', 'MTS'])) {
            return 3;
        }

        if (in_array($pendidikan, ['SD', 'MI'])) {
            return 2;
        }

        if (in_array($pendidikan, ['TIDAK SEKOLAH', 'BELUM SEKOLAH'])) {
            return 1;
        }

        return 1;
    }

    // Mengikuti Excel QUARTILE.EXC / PERCENTILE.EXC
    private function quartileExc(array $data, float $quart): float
    {
        $count = count($data);

        if ($count < 2) {
            return $count === 1 ? (float) $data[0] : 0;
        }

        sort($data);

        $rank = ($count + 1) * $quart;

        if ($rank <= 1) {
            return (float) $data[0];
        }

        if ($rank >= $count) {
            return (float) $data[$count - 1];
        }

        $lowerIndex = (int) floor($rank) - 1;
        $upperIndex = (int) ceil($rank) - 1;
        $fraction = $rank - floor($rank);

        if ($lowerIndex === $upperIndex) {
            return (float) $data[$lowerIndex];
        }

        return (float) (
            $data[$lowerIndex] +
            ($fraction * ($data[$upperIndex] - $data[$lowerIndex]))
        );
    }

    // Dinamis berdasarkan quartile:
    // < Q1 = Tinggi
    // >= Q1 dan < Q3 = Sedang
    // >= Q3 = Rendah
    private function kategoriRisikoQuartile(float $total, float $q1, float $q3): string
    {
        if ($total < $q1) {
            return 'Tinggi';
        }

        if ($total >= $q3) {
            return 'Rendah';
        }

        return 'Sedang';
    }

    private function generateRekomendasiList(string $kategori, ?string $faktor): array
{
    $list = [];

    if ($kategori === 'Tinggi') {

        if ($faktor === 'Ketidak hadiran') {
            $list = [
                'Pemantauan kehadiran harian',
                'Komunikasi intensif dengan orang tua',
                'Home visit',
                'Konseling siswa',
                'Pendampingan wali kelas',
            ];
        }

        elseif ($faktor === 'Nilai Rata Rata Akademik') {
            $list = [
                'Bimbingan belajar intensif',
                'Program remedial',
                'Pendampingan guru kelas',
                'Evaluasi capaian belajar berkala',
            ];
        }

        else {
            $list = [
                'Pendampingan khusus oleh wali kelas',
                'Koordinasi dengan orang tua',
            ];
        }
    }

    elseif ($kategori === 'Sedang') {
        $list = [
            'Monitoring berkala',
            'Motivasi belajar',
            'Komunikasi ringan dengan orang tua',
        ];
    }

    else {
        $list = [
            'Monitoring rutin',
            'Pemberian apresiasi',
        ];
    }

    return $list;
}
}
