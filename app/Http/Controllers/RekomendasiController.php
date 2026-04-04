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
        ]);

        $hasil = DB::table('hasil_keputusan')
            ->where('id_hasil', $id)
            ->first();

        if (!$hasil) {
            return back()->with('error', 'Data hasil keputusan tidak ditemukan.');
        }

        $rekomendasiFinal = DB::table('rekomendasi')
            ->where('id_hasil', $id)
            ->where('is_selected', 1)
            ->first();

        if (!$rekomendasiFinal && !empty($hasil->tindak_lanjut_final)) {
            $rekomendasiFinal = DB::table('rekomendasi')
                ->where('id_hasil', $id)
                ->where('deskripsi_rekomendasi', $hasil->tindak_lanjut_final)
                ->first();

            // Auto-fix: set is_selected = 1 supaya ke depannya konsisten
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

        DB::table('rekomendasi')
            ->where('id_rekomendasi', $rekomendasiFinal->id_rekomendasi)
            ->update([
                'status' => $request->status,
                'tanggal_update' => now(),
            ]);

        return back()->with('success', 'Status rekomendasi berhasil diperbarui.');
    }
}