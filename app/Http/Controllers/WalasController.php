<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilKeputusan; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalasController extends Controller
{
    public function dashboard()
{
    $id_kelas = Auth::user()->id_kelas;

    // Ambil periode aktif
    $periodeAktif = DB::table('periode_penilaian')
        ->where('status', 'aktif')
        ->first();

    // Data siswa dari evaluasi_siswa (periode aktif + kelas walas)
    $dataSiswa = collect();
    if ($periodeAktif) {
        $dataSiswa = DB::table('evaluasi_siswa')
            ->join('siswa', 'evaluasi_siswa.id_siswa', '=', 'siswa.id_siswa')
            ->where('evaluasi_siswa.id_kelas', $id_kelas)
            ->where('evaluasi_siswa.id_periode', $periodeAktif->id_periode)
            ->select(
                'siswa.nama_siswa',
                'siswa.nisn',
                'evaluasi_siswa.nilai_rata_rata',
                'evaluasi_siswa.total_ketidakhadiran',
                'evaluasi_siswa.pekerjaan_ortu',
                'evaluasi_siswa.pendidikan_ortu'
            )
            ->orderBy('siswa.nama_siswa')
            ->get();
    }

    // ✅ Top 5 siswa risiko tinggi - urutan sama dengan hasil analisis
$topSiswaTinggi = HasilKeputusan::with('siswa')
    ->whereHas('siswa', function($q) use ($id_kelas) {
        $q->where('id_kelas', $id_kelas);
    })
    ->where('kategori_risiko', 'Tinggi')
    ->when($periodeAktif, function($q) use ($periodeAktif) {
        $q->where('id_periode', $periodeAktif->id_periode);
    })
    ->orderBy('total_nilai_preferensi', 'asc') // ✅ asc = sama dengan hasil analisis
    ->limit(5)
    ->get();

    // Chart Sebaran Risiko
    $dataRisiko = [
        'Tinggi' => HasilKeputusan::whereHas('siswa', function($q) use ($id_kelas) {
            $q->where('id_kelas', $id_kelas);
        })->where('kategori_risiko', 'Tinggi')->count(),
        'Sedang' => HasilKeputusan::whereHas('siswa', function($q) use ($id_kelas) {
            $q->where('id_kelas', $id_kelas);
        })->where('kategori_risiko', 'Sedang')->count(),
        'Rendah' => HasilKeputusan::whereHas('siswa', function($q) use ($id_kelas) {
            $q->where('id_kelas', $id_kelas);
        })->where('kategori_risiko', 'Rendah')->count(),
    ];

    // Chart Faktor Dominan
    $faktorDominan = HasilKeputusan::whereHas('siswa', function($q) use ($id_kelas) {
            $q->where('id_kelas', $id_kelas);
        })
        ->select('faktor_dominan', DB::raw('count(*) as total'))
        ->groupBy('faktor_dominan')
        ->orderBy('total', 'desc')
        ->whereNotNull('faktor_dominan')
        ->limit(5)
        ->get();

    return view('walas.dashboard', compact(
        'dataRisiko', 'faktorDominan', 'dataSiswa', 'periodeAktif', 'topSiswaTinggi'
    ));
}}