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
            'tanggal_pelaksanaan' => 'required|date',
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
                'tanggal_dilaksanakan' => $request->tanggal_pelaksanaan,
                'tanggal_update' => now(),
            ]);

        // 📝 LOG ACTIVITY
        DB::table('log_activities')->insert([
            'user_id'    => auth()->id(),
            'role'       => auth()->user()->role,
            'activity'   => 'Update status rekomendasi "' . $rekomendasiFinal->deskripsi_rekomendasi . '" menjadi ' . $request->status . ', tanggal pelaksanaan: ' . $request->tanggal_pelaksanaan,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Status rekomendasi berhasil diperbarui.');
    }

    // 💬 SIMPAN KOMENTAR CHATBOX
    public function simpanKomentar(Request $request, $id_hasil)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        DB::table('rekomendasi_komentar')->insert([
            'id_hasil'   => $id_hasil,
            'user_id'    => auth()->id(),
            'role'       => auth()->user()->role,
            'nama_user'  => auth()->user()->name,
            'komentar'   => $request->komentar,
            'created_at' => now(),
        ]);

        // 📝 LOG ACTIVITY
        DB::table('log_activities')->insert([
            'user_id'    => auth()->id(),
            'role'       => auth()->user()->role,
            'activity'   => 'Menambahkan komentar pada rekomendasi id_hasil: ' . $id_hasil,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}