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

        return view('mfep.index', compact('periodeAktif'));
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

        return redirect()->route('walas.mfep.hasil', ['id_periode' => $idPeriode])
            ->with('success', 'Proses analisis MFEP berhasil dijalankan untuk periode aktif.');
    }

    public function hasil(Request $request)
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

            $query = HasilKeputusan::with([
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
        if (!auth()->check() || auth()->user()->role !== 'kepsek') {
            abort(403);
        }

        $request->validate([
            'id_hasil' => 'required|integer|exists:hasil_keputusan,id_hasil',
            'id_rekomendasi' => 'required|integer|exists:rekomendasi,id_rekomendasi',
        ]);

        DB::transaction(function () use ($request) {
            $hasil = HasilKeputusan::with('rekomendasi')
                ->where('id_hasil', $request->id_hasil)
                ->firstOrFail();

            $rekomendasiDipilih = $hasil->rekomendasi
                ->where('id_rekomendasi', (int) $request->id_rekomendasi)
                ->first();

            if (!$rekomendasiDipilih) {
                abort(422, 'Rekomendasi tidak cocok dengan hasil keputusan.');
            }

            Rekomendasi::where('id_hasil', $hasil->id_hasil)->update([
                'is_selected' => 0,
                'tanggal_update' => now(),
            ]);

            Rekomendasi::where('id_rekomendasi', $rekomendasiDipilih->id_rekomendasi)->update([
                'is_selected' => 1,
                'tanggal_update' => now(),
            ]);

            HasilKeputusan::where('id_hasil', $hasil->id_hasil)->update([
                'tindak_lanjut_final' => $rekomendasiDipilih->deskripsi_rekomendasi,
                'tanggal_keputusan' => now(),
            ]);
        });

        return redirect()->back()->with('success', 'Rekomendasi final berhasil dipilih.');
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
}