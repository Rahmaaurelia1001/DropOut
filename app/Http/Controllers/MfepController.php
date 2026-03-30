<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiSiswa;
use App\Models\HasilKeputusan;
use App\Models\NilaiMapel;
use App\Models\PeriodePenilaian;
use App\Models\Presensi;
use App\Services\EvaluasiSiswaService;
use App\Services\MfepService;
use Illuminate\Http\Request;

class MfepController extends Controller
{
    public function index()
    {
        $periodeAktif = PeriodePenilaian::where('status', 'Aktif')->first();

        return view('mfep.index', compact('periodeAktif'));
    }

    public function proses(EvaluasiSiswaService $evaluasiSiswaService, MfepService $mfepService)
    {
        $periodeAktif = PeriodePenilaian::where('status', 'Aktif')->first();

        if (!$periodeAktif) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Belum ada periode penilaian yang aktif. Silakan hubungi admin.');
        }

        $idPeriode = (int) $periodeAktif->id_periode;

        $adaNilai = NilaiMapel::where('id_periode', $idPeriode)->exists();
        $adaPresensi = Presensi::where('id_periode', $idPeriode)->exists();
        $adaEvaluasi = EvaluasiSiswa::where('id_periode', $idPeriode)->exists();

        if (!$adaNilai) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Data nilai mapel pada periode aktif belum tersedia. Silakan upload data terlebih dahulu.');
        }

        if (!$adaPresensi && !$adaEvaluasi) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Data presensi atau evaluasi pada periode aktif belum tersedia. Silakan upload data terlebih dahulu.');
        }

        $totalBobot = \App\Models\Kriteria::sum('bobot');

        if ((float) $totalBobot !== 1.0) {
            return redirect()->route('walas.mfep.index')
                ->with('error', 'Total bobot kriteria harus sama dengan 1 sebelum analisis dijalankan.');
        }

        $evaluasiSiswaService->generate($idPeriode);
        $mfepService->generatePenilaian($idPeriode);
        $mfepService->hitungMfep($idPeriode);

        return redirect()->route('walas.mfep.hasil', ['id_periode' => $idPeriode])
            ->with('success', 'Proses analisis MFEP berhasil dijalankan untuk periode aktif.');
    }

    public function hasil(Request $request)
{
    $periodes = PeriodePenilaian::orderBy('id_periode', 'desc')->get();
    $kelasList = \App\Models\Kelas::orderBy('nama_kelas', 'asc')->get();

    $idPeriode = $request->id_periode;
    $idKelas = $request->id_kelas;

    if (!$idPeriode) {
        $periodeAktif = PeriodePenilaian::where('status', 'Aktif')->first();
        $idPeriode = $periodeAktif?->id_periode;
    }

    $periode = null;
    $hasil = collect();

    if ($idPeriode) {
        $periode = PeriodePenilaian::where('id_periode', $idPeriode)->first();

        $query = HasilKeputusan::with(['siswa', 'rekomendasi'])
            ->where('id_periode', $idPeriode)
            ->orderBy('total_nilai_preferensi', 'asc');

        if (auth()->check() && auth()->user()->role === 'kepsek' && $idKelas) {
            $query->whereHas('siswa', function ($q) use ($idKelas) {
                $q->where('id_kelas', $idKelas);
            });
        }

        $hasil = $query->get();
    }

    if (auth()->check() && auth()->user()->role === 'kepsek') {
        return view('kepsek.mfep.hasil', compact('hasil', 'periode', 'periodes', 'idPeriode', 'kelasList', 'idKelas'));
    }

    return view('mfep.hasil', compact('hasil', 'periode', 'periodes', 'idPeriode'));
}


public function pilihRekomendasi(Request $request)
{
    $request->validate([
        'id_hasil' => 'required|exists:hasil_keputusan,id_hasil',
        'id_rekomendasi' => 'required|exists:rekomendasi,id_rekomendasi',
    ]);

    \Illuminate\Support\Facades\DB::table('rekomendasi')
        ->where('id_hasil', $request->id_hasil)
        ->update([
            'is_selected' => 0,
            'tanggal_update' => now(),
        ]);

    \Illuminate\Support\Facades\DB::table('rekomendasi')
        ->where('id_rekomendasi', $request->id_rekomendasi)
        ->where('id_hasil', $request->id_hasil)
        ->update([
            'is_selected' => 1,
            'tanggal_update' => now(),
        ]);

    $rekomendasi = \App\Models\Rekomendasi::where('id_rekomendasi', $request->id_rekomendasi)
        ->where('id_hasil', $request->id_hasil)
        ->firstOrFail();

    \Illuminate\Support\Facades\DB::table('hasil_keputusan')
        ->where('id_hasil', $request->id_hasil)
        ->update([
            'tindak_lanjut_final' => $rekomendasi->deskripsi_rekomendasi,
            'tanggal_keputusan' => now(),
        ]);

    return back()->with('success', 'Keputusan berhasil disimpan');
}

public function riwayat(Request $request)
{
    $keyword = $request->keyword;

    $siswa = null;
    $riwayat = collect();

    if ($keyword) {
        $siswa = \App\Models\Siswa::where('nisn', $keyword)
            ->orWhere('nama_siswa', 'like', '%' . $keyword . '%')
            ->first();

        if ($siswa) {
            $riwayat = \App\Models\HasilKeputusan::with(['rekomendasi', 'siswa', 'periode'])
                ->where('id_siswa', $siswa->id_siswa)
                ->orderBy('id_periode', 'asc')
                ->get();
        }
    }

    return view('walas.riwayat', compact('keyword', 'siswa', 'riwayat'));
}
}