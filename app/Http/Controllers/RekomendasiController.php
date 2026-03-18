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

        DB::table('rekomendasi')
            ->where('id_rekomendasi', $id)
            ->update([
                'status' => $request->status,
                'tanggal_update' => now(),
            ]);

        return back()->with('success', 'Status tindak lanjut berhasil diperbarui.');
    }
}