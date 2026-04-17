<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
    public function updateStatus(Request $request, $id)

{

 
    $request->validate([
        'status' => 'required|in:belum_diproses,sedang_diproses,selesai',
        'tanggal_pelaksanaan' => 'required|date', // 🔥 wajib
    ]);

    $hasil = DB::table('hasil_keputusan')
        ->where('id_hasil', $id)
        ->first();

    if (!$hasil) {
        return back()->with('error', 'Data hasil keputusan tidak ditemukan.');
    }

    // 🔥 ambil rekomendasi yang dipilih kepsek
    $rekomendasiFinal = DB::table('rekomendasi')
        ->where('id_hasil', $id)
        ->where('is_selected', 1)
        ->first();

    // 🔥 fallback kalau belum sinkron
    if (!$rekomendasiFinal && !empty($hasil->tindak_lanjut_final)) {
        $rekomendasiFinal = DB::table('rekomendasi')
            ->where('id_hasil', $id)
            ->where('deskripsi_rekomendasi', $hasil->tindak_lanjut_final)
            ->first();

        if ($rekomendasiFinal) {
            DB::table('rekomendasi')
                ->where('id_hasil', $id)
                ->update(['is_selected' => 0]);

            DB::table('rekomendasi')
                ->where('id_rekomendasi', $rekomendasiFinal->id_rekomendasi)
                ->update(['is_selected' => 1]);
        }
    }

    if (!$rekomendasiFinal) {
        return back()->with('error', 'Status gagal diperbarui. Rekomendasi final belum sinkron.');
    }

    // 🔥 UPDATE UTAMA (INI YANG PENTING)
    DB::table('rekomendasi')
        ->where('id_rekomendasi', $rekomendasiFinal->id_rekomendasi)
        ->update([
            'status' => $request->status,
            'tanggal_dilaksanakan' => $request->tanggal_pelaksanaan, // ✅ sesuai DB kamu
            'tanggal_update' => now(),
        ]);

    // 📝 LOG ACTIVITY
        DB::table('log_activities')->insert([
            'user_id'    => auth()->id(),
            'role'       => auth()->user()->role, // sesuaikan dengan nama kolom role di tabel users kamu
            'activity'   => 'Update status rekomendasi "' . $rekomendasiFinal->deskripsi_rekomendasi . '" menjadi ' . $request->status . ', tanggal pelaksanaan: ' . $request->tanggal_pelaksanaan,
            'created_at' => now(),
        ]);

    return back()->with('success', 'Status rekomendasi berhasil diperbarui.');

    
}


}