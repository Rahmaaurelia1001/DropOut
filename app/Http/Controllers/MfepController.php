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

        $evaluasiSiswaService->generate($idPeriode);
        $mfepService->generatePenilaian($idPeriode);
        $mfepService->hitungMfep($idPeriode);

        return redirect()->route('walas.mfep.hasil', ['id_periode' => $idPeriode])
            ->with('success', 'Proses analisis MFEP berhasil dijalankan untuk periode aktif.');
    }

    public function hasil(Request $request)
    {
        $periodes = PeriodePenilaian::orderBy('id_periode', 'desc')->get();

        $idPeriode = $request->id_periode;

        if (!$idPeriode) {
            $periodeAktif = PeriodePenilaian::where('status', 'Aktif')->first();
            $idPeriode = $periodeAktif?->id_periode;
        }

        $periode = null;
        $hasil = collect();

        if ($idPeriode) {
            $periode = PeriodePenilaian::where('id_periode', $idPeriode)->first();

            $hasil = HasilKeputusan::with(['siswa', 'rekomendasi'])
                ->where('id_periode', $idPeriode)
                ->orderBy('total_nilai_preferensi', 'asc')
                ->get();
        }

        if (auth()->check() && auth()->user()->role === 'kepsek') {
            return view('kepsek.mfep.hasil', compact('hasil', 'periode', 'periodes', 'idPeriode'));
        }

        return view('mfep.hasil', compact('hasil', 'periode', 'periodes', 'idPeriode'));
    }

    public function pilihRekomendasi(Request $request)
    {
        $request->validate([
            'id_hasil' => 'required|exists:hasil_keputusan,id_hasil',
            'rekomendasi' => 'required|string',
        ]);

        $hasil = HasilKeputusan::findOrFail($request->id_hasil);
        $hasil->tindak_lanjut_final = $request->rekomendasi;
        $hasil->tanggal_keputusan = now();
        $hasil->save();

        return back()->with('success', 'Keputusan berhasil disimpan');
    }
}