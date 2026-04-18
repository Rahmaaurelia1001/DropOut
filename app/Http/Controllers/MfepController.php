<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiSiswa;
use App\Models\HasilKeputusan;
use App\Models\Kelas;
use App\Models\NilaiMapel;
use App\Models\PeriodePenilaian;
use App\Models\Presensi;
use App\Models\Rekomendasi;
use App\Models\Siswa;
use App\Services\EvaluasiSiswaService;
use App\Services\MfepService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class MfepController extends Controller
{
    public function index()
{
    $periodeAktif = PeriodePenilaian::where('status', 'aktif')->first();

    $jumlahSiswa    = 0;
    $jumlahKriteria = 0;
    $sudahAdaHasil  = false;

    if ($periodeAktif) {
        $idKelasWalas = auth()->user()->id_kelas ?? null;

        if ($idKelasWalas) {
            $idSiswaKelas = Siswa::where('id_kelas', $idKelasWalas)->pluck('id_siswa');

            // Cek apakah ada nilai mapel DAN (presensi atau evaluasi)
            $adaNilai    = NilaiMapel::where('id_periode', $periodeAktif->id_periode)
                               ->whereIn('id_siswa', $idSiswaKelas)->exists();
            $adaPresensi = Presensi::where('id_periode', $periodeAktif->id_periode)
                               ->whereIn('id_siswa', $idSiswaKelas)->exists();
            $adaEvaluasi = EvaluasiSiswa::where('id_periode', $periodeAktif->id_periode)
                               ->whereIn('id_siswa', $idSiswaKelas)->exists();

            if ($adaNilai && ($adaPresensi || $adaEvaluasi)) {
                $jumlahSiswa = $idSiswaKelas->count();
            }
        }

        $totalBobot     = \App\Models\Kriteria::sum('bobot');
        $jumlahKriteria = abs((float) $totalBobot - 1) <= 0.0001
                          ? \App\Models\Kriteria::count()
                          : 0;

        $sudahAdaHasil  = HasilKeputusan::where('id_periode', $periodeAktif->id_periode)->exists();
    }

    return view('mfep.index', compact(
        'periodeAktif',
        'jumlahSiswa',
        'jumlahKriteria',
        'sudahAdaHasil'
    ));
}


    public function proses(EvaluasiSiswaService $evaluasiSiswaService, MfepService $mfepService)
    {
        $periodeAktif = PeriodePenilaian::where('status', 'aktif')->first();

        if (!$periodeAktif) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Belum ada periode penilaian yang aktif. Silakan hubungi admin.');
        }

        $idPeriode = (int) $periodeAktif->id_periode;
        $idKelasWalas = auth()->user()->id_kelas ?? null;

        if (!$idKelasWalas) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Akun wali kelas belum terhubung dengan kelas. Silakan hubungi admin.');
        }

        $idSiswaKelas = Siswa::where('id_kelas', $idKelasWalas)->pluck('id_siswa');

        if ($idSiswaKelas->isEmpty()) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Belum ada data siswa pada kelas yang Anda ampu.');
        }

        $adaNilai = NilaiMapel::where('id_periode', $idPeriode)
            ->whereIn('id_siswa', $idSiswaKelas)
            ->exists();

        $adaPresensi = Presensi::where('id_periode', $idPeriode)
            ->whereIn('id_siswa', $idSiswaKelas)
            ->exists();

        $adaEvaluasi = EvaluasiSiswa::where('id_periode', $idPeriode)
            ->whereIn('id_siswa', $idSiswaKelas)
            ->exists();

        if (!$adaNilai) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Data nilai mapel pada periode aktif belum tersedia. Silakan upload data terlebih dahulu.');
        }

        if (!$adaPresensi && !$adaEvaluasi) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Data presensi atau evaluasi pada periode aktif belum tersedia. Silakan upload data terlebih dahulu.');
        }

        $totalBobot = \App\Models\Kriteria::sum('bobot');

        if (abs((float) $totalBobot - 1) > 0.0001) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Total bobot kriteria harus sama dengan 1 sebelum analisis dijalankan.');
        }

        $evaluasiSiswaService->generate($idPeriode, $idKelasWalas);
        $mfepService->generatePenilaian($idPeriode, $idKelasWalas);
        $mfepService->hitungMfep($idPeriode, $idKelasWalas);

        // 📝 LOG ACTIVITY
        DB::table('log_activities')->insert([
            'user_id'    => auth()->id(),
            'role'       => auth()->user()->role,
            'activity'   => 'Menjalankan analisis MFEP pada periode: ' . $periodeAktif->tahun_ajaran . ' Semester ' . $periodeAktif->semester,
            'created_at' => now(),
        ]);

        return redirect()->route('walas.mfep.hasil', ['id_periode' => $idPeriode])
            ->with('success', 'Proses analisis MFEP berhasil dijalankan untuk periode aktif.');
    }

    public function hasil(Request $request)
    {
        $periodes = \App\Models\PeriodePenilaian::orderBy('id_periode', 'desc')->get();
        $kelasList = \App\Models\Kelas::orderBy('nama_kelas', 'asc')->get();

        $idPeriode = $request->id_periode;
        $idKelas = $request->id_kelas;

        if (!$idPeriode) {
            $periodeAktif = \App\Models\PeriodePenilaian::where('status', 'aktif')->first();
            $idPeriode = $periodeAktif?->id_periode;
        }

        $periode = null;
        $hasil = collect();

        if ($idPeriode) {
            $periode = \App\Models\PeriodePenilaian::where('id_periode', $idPeriode)->first();

            $query = \App\Models\HasilKeputusan::with([
                    'siswa.kelas',
                    'rekomendasi' => function ($q) {
                        $q->orderBy('id_rekomendasi', 'asc');
                    }
                ])
                ->where('id_periode', $idPeriode)
                ->orderBy('total_nilai_preferensi', 'asc');

            if (auth()->check() && auth()->user()->role === 'wali_kelas') {
                $idKelasWalas = auth()->user()->id_kelas;

                $query->whereHas('siswa', function ($q) use ($idKelasWalas) {
                    $q->where('id_kelas', $idKelasWalas);
                });
            }

            if (auth()->check() && auth()->user()->role === 'kepsek' && $idKelas) {
                $query->whereHas('siswa', function ($q) use ($idKelas) {
                    $q->where('id_kelas', $idKelas);
                });
            }

            $hasil = $query->get();
        }

        if (auth()->check() && auth()->user()->role === 'kepsek') {
            return view('kepsek.mfep.hasil', compact(
                'hasil',
                'periode',
                'periodes',
                'idPeriode',
                'kelasList',
                'idKelas'
            ));
        }

        return view('mfep.hasil', compact(
            'hasil',
            'periode',
            'periodes',
            'idPeriode'
        ));
    }

    public function pilihRekomendasi(Request $request)
    {
        $request->validate([
            'id_hasil' => 'required|integer|exists:hasil_keputusan,id_hasil',
            'id_rekomendasi' => 'required|integer|exists:rekomendasi,id_rekomendasi',
        ]);

        DB::transaction(function () use ($request) {
            $rekomendasiDipilih = \App\Models\Rekomendasi::where('id_rekomendasi', $request->id_rekomendasi)
                ->where('id_hasil', $request->id_hasil)
                ->firstOrFail();

            \App\Models\Rekomendasi::where('id_hasil', $request->id_hasil)
                ->update([
                    'is_selected' => 0,
                    'tanggal_update' => now(),
                ]);

            \App\Models\Rekomendasi::where('id_rekomendasi', $request->id_rekomendasi)
                ->update([
                    'is_selected' => 1,
                    'tanggal_update' => now(),
                ]);

            \App\Models\HasilKeputusan::where('id_hasil', $request->id_hasil)
                ->update([
                    'tindak_lanjut_final' => $rekomendasiDipilih->deskripsi_rekomendasi,
                    'tanggal_keputusan' => now(),
                ]);

            // 📝 LOG ACTIVITY
            DB::table('log_activities')->insert([
                'user_id'    => auth()->id(),
                'role'       => auth()->user()->role,
                'activity'   => 'Memilih rekomendasi final: "' . $rekomendasiDipilih->deskripsi_rekomendasi . '" untuk id_hasil: ' . $request->id_hasil,
                'created_at' => now(),
            ]);
        });

        return back()->with('success', 'Rekomendasi final berhasil dipilih.');
    }

    public function riwayat(Request $request)
    {
        $keyword = $request->keyword;

        $siswa = null;
        $riwayat = collect();

        if ($keyword) {
            $querySiswa = Siswa::query();

            if (auth()->check() && auth()->user()->role === 'wali_kelas') {
                $querySiswa->where('id_kelas', auth()->user()->id_kelas);
            }

            $siswa = $querySiswa->where(function ($q) use ($keyword) {
                $q->where('nisn', $keyword)
                  ->orWhere('nama_siswa', 'like', '%' . $keyword . '%');
            })->first();

            if ($siswa) {
                $riwayat = HasilKeputusan::with([
                        'rekomendasi',
                        'siswa.kelas',
                        'periode'
                    ])
                    ->where('id_siswa', $siswa->id_siswa)
                    ->orderBy('id_periode', 'asc')
                    ->get();
            }
        }

        return view('walas.riwayat', compact('keyword', 'siswa', 'riwayat'));
    }

    public function ranking(Request $request)
    {
        $periodes = PeriodePenilaian::orderBy('id_periode', 'desc')->get();
        $kelasList = Kelas::orderBy('nama_kelas', 'asc')->get();

        $idPeriode = $request->id_periode;
        $idKelas = $request->id_kelas;

        if (!$idPeriode) {
            $periodeAktif = PeriodePenilaian::where('status', 'aktif')->first();
            $idPeriode = $periodeAktif?->id_periode;
        }

        $periode = null;
        $hasil = collect();

        if ($idPeriode) {
            $periode = PeriodePenilaian::where('id_periode', $idPeriode)->first();

            $query = HasilKeputusan::with(['siswa.kelas'])
                ->where('id_periode', $idPeriode)
                ->orderBy('total_nilai_preferensi', 'asc');

            if ($idKelas) {
                $query->whereHas('siswa', function ($q) use ($idKelas) {
                    $q->where('id_kelas', $idKelas);
                });
            }

            $hasil = $query->get();
        }

        return view('kepsek.ranking', compact(
            'hasil',
            'periode',
            'periodes',
            'kelasList',
            'idPeriode',
            'idKelas'
        ));
    }

    public function exportLaporanPdf(Request $request)
    {
        $idPeriode = $request->id_periode;
        $idKelas = $request->id_kelas;

        if (!$idPeriode) {
            $periodeAktif = PeriodePenilaian::where('status', 'aktif')->first();
            $idPeriode = $periodeAktif?->id_periode;
        }

        $periode = null;
        $kelas = null;
        $hasil = collect();

        if ($idPeriode) {
            $periode = PeriodePenilaian::where('id_periode', $idPeriode)->first();

            $query = HasilKeputusan::with(['siswa.kelas'])
                ->where('id_periode', $idPeriode)
                ->orderBy('total_nilai_preferensi', 'asc');

            if ($idKelas) {
                $kelas = Kelas::where('id_kelas', $idKelas)->first();

                $query->whereHas('siswa', function ($q) use ($idKelas) {
                    $q->where('id_kelas', $idKelas);
                });
            }

            $hasil = $query->get();
        }

        $pdf = Pdf::loadView('kepsek.laporan_pdf', [
            'hasil' => $hasil,
            'periode' => $periode,
            'kelas' => $kelas,
        ])->setPaper('a4', 'landscape');

        $namaFile = 'laporan-spk'
        . ($periode ? '-' . str_replace('/', '-', $periode->tahun_ajaran) . '-semester-' . $periode->semester : '')
        . ($kelas ? '-' . str_replace(' ', '-', $kelas->nama_kelas) : '')
        . '.pdf';

        // 📝 LOG ACTIVITY
        DB::table('log_activities')->insert([
            'user_id'    => auth()->id(),
            'role'       => auth()->user()->role,
            'activity'   => 'Export laporan PDF periode: ' . ($periode ? $periode->tahun_ajaran . ' Semester ' . $periode->semester : '-') . ($kelas ? ' kelas: ' . $kelas->nama_kelas : ' semua kelas'),
            'created_at' => now(),
        ]);

        return $pdf->download($namaFile);
    }

    public function laporan(Request $request)
    {
        $periodes = PeriodePenilaian::orderBy('id_periode', 'desc')->get();
        $kelasList = Kelas::orderBy('nama_kelas', 'asc')->get();

        $idPeriode = $request->id_periode;
        $idKelas = $request->id_kelas;

        if (!$idPeriode) {
            $periodeAktif = PeriodePenilaian::where('status', 'aktif')->first();
            $idPeriode = $periodeAktif?->id_periode;
        }

        $periode = null;
        $hasil = collect();

        if ($idPeriode) {
            $periode = PeriodePenilaian::where('id_periode', $idPeriode)->first();

            $query = HasilKeputusan::with(['siswa.kelas'])
                ->where('id_periode', $idPeriode)
                ->orderBy('total_nilai_preferensi', 'asc');

            if ($idKelas) {
                $query->whereHas('siswa', function ($q) use ($idKelas) {
                    $q->where('id_kelas', $idKelas);
                });
            }

            $hasil = $query->get();
        }

        return view('kepsek.laporan', compact(
            'hasil',
            'periode',
            'periodes',
            'kelasList',
            'idPeriode',
            'idKelas'
        ));
    }

    public function dashboardKepsek(Request $request)
    {
        $periodes = PeriodePenilaian::orderBy('id_periode', 'desc')->get();

        $idPeriode = $request->id_periode;

        if (!$idPeriode) {
            $periodeAktif = PeriodePenilaian::where('status', 'aktif')->first();
            $idPeriode = $periodeAktif?->id_periode;
        }

        $periode = null;
        $hasil = collect();

        if ($idPeriode) {
            $periode = PeriodePenilaian::where('id_periode', $idPeriode)->first();

            $hasil = HasilKeputusan::with(['siswa.kelas'])
                ->where('id_periode', $idPeriode)
                ->get();
        }

        $totalSiswa = $hasil->count();
        $jumlahTinggi = $hasil->where('kategori_risiko', 'Tinggi')->count();
        $jumlahSedang = $hasil->where('kategori_risiko', 'Sedang')->count();
        $jumlahRendah = $hasil->where('kategori_risiko', 'Rendah')->count();

        $faktorDominanTerbanyak = $hasil
            ->groupBy('faktor_dominan')
            ->map->count()
            ->sortDesc()
            ->keys()
            ->first();

        $topSiswaTinggi = collect();

        if ($idPeriode) {
            $topSiswaTinggi = HasilKeputusan::with(['siswa.kelas'])
                ->where('id_periode', $idPeriode)
                ->where('kategori_risiko', 'Tinggi')
                ->orderBy('total_nilai_preferensi', 'desc')
                ->limit(5)
                ->get();
        }

        $statusPerKelas = HasilKeputusan::select(
            'siswa.id_kelas',
            'kelas.nama_kelas',
            DB::raw("SUM(CASE 
                        WHEN rekomendasi.id_rekomendasi IS NULL THEN 1
                        WHEN rekomendasi.status = 'belum_diproses' THEN 1
                        ELSE 0
                    END) as belum"),
            DB::raw("SUM(CASE WHEN rekomendasi.status = 'sedang_diproses' THEN 1 ELSE 0 END) as proses"),
            DB::raw("SUM(CASE WHEN rekomendasi.status = 'selesai' THEN 1 ELSE 0 END) as selesai"),
            DB::raw("COUNT(hasil_keputusan.id_hasil) as total")
        )
        ->join('siswa', 'hasil_keputusan.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->leftJoin('rekomendasi', function ($join) {
            $join->on('hasil_keputusan.id_hasil', '=', 'rekomendasi.id_hasil')
                 ->where('rekomendasi.is_selected', 1);
        })
        ->where('hasil_keputusan.id_periode', $idPeriode)
        ->groupBy('siswa.id_kelas', 'kelas.nama_kelas')
        ->orderBy('kelas.nama_kelas', 'asc')
        ->get();

        $risikoPerKelas = \App\Models\Kelas::select(
            'kelas.nama_kelas',
            DB::raw("COUNT(CASE WHEN hasil_keputusan.kategori_risiko = 'Tinggi' THEN 1 END) as total_risiko_tinggi")
        )
        ->leftJoin('siswa', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        ->leftJoin('hasil_keputusan', function ($join) use ($idPeriode) {
            $join->on('siswa.id_siswa', '=', 'hasil_keputusan.id_siswa')
                ->where('hasil_keputusan.id_periode', $idPeriode);
        })
        ->groupBy('kelas.nama_kelas')
        ->orderBy('kelas.nama_kelas', 'asc')
        ->get();

        return view('kepsek.dashboard', compact(
            'periodes',
            'idPeriode',
            'periode',
            'totalSiswa',
            'jumlahTinggi',
            'jumlahSedang',
            'jumlahRendah',
            'faktorDominanTerbanyak',
            'statusPerKelas',
            'topSiswaTinggi',
            'risikoPerKelas'
        ));
    }

    public function simpanDeskripsiTambahan(Request $request, $id_hasil)
{
    $request->validate([
        'deskripsi_tambahan' => 'required|string|max:2000',
    ]);

    DB::table('hasil_keputusan')
        ->where('id_hasil', $id_hasil)
        ->update([
            'deskripsi_tambahan' => $request->deskripsi_tambahan,
        ]);

    // 📝 LOG ACTIVITY
    DB::table('log_activities')->insert([
        'user_id'    => auth()->id(),
        'role'       => auth()->user()->role,
        'activity'   => 'Menambahkan deskripsi tambahan pada id_hasil: ' . $id_hasil,
        'created_at' => now(),
    ]);

    return back()->with('success', 'Deskripsi tambahan berhasil disimpan.');
}
}