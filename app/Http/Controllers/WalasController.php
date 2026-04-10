<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// GANTI INI: Sesuaikan dengan nama model yang ada di folder Models kamu
use App\Models\HasilKeputusan; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalasController extends Controller
{
    public function dashboard()
    {
        // Ambil ID Kelas walas yang sedang login
        $id_kelas = Auth::user()->id_kelas;

        // 1. Data Chart Sebaran Risiko (Gunakan HasilKeputusan)
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

        // 2. Data Chart Faktor Dominan (Top 5)
        $faktorDominan = HasilKeputusan::whereHas('siswa', function($q) use ($id_kelas) {
                $q->where('id_kelas', $id_kelas);
            })
            ->select('faktor_dominan', DB::raw('count(*) as total'))
            ->groupBy('faktor_dominan')
            ->orderBy('total', 'desc')
            ->whereNotNull('faktor_dominan')
            ->limit(5)
            ->get();

        return view('walas.dashboard', compact('dataRisiko', 'faktorDominan'));
    }
}