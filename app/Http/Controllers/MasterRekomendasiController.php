<?php

namespace App\Http\Controllers;

use App\Models\MasterRekomendasi;
use Illuminate\Http\Request;

class MasterRekomendasiController extends Controller
{
    public function index()
    {
        $masterRekomendasi = MasterRekomendasi::orderBy('kategori_risiko')
            ->orderBy('faktor_dominan')
            ->latest()
            ->get();

        return view('admin.master_rekomendasi.index', compact('masterRekomendasi'));
    }

    public function create()
    {
        $kategoriOptions = ['Tinggi', 'Sedang', 'Rendah'];

        $faktorOptions = [
            'Nilai Rata Rata Akademik',
            'Ketidak hadiran',
            'Pekerjaan orang tua',
            'Pendidikan Orang Tua',
        ];

        return view('admin.master_rekomendasi.create', compact('kategoriOptions', 'faktorOptions'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kategori_risiko'      => 'required|in:Tinggi,Sedang,Rendah',
        'faktor_dominan'       => 'required|in:Nilai Rata Rata Akademik,Ketidak hadiran,Pekerjaan orang tua,Pendidikan Orang Tua',
        'deskripsi_rekomendasi'=> 'required|string',
        // ✅ is_active dihapus dari validasi
    ]);

    MasterRekomendasi::create([
        'kategori_risiko'       => $request->kategori_risiko,
        'faktor_dominan'        => $request->faktor_dominan,
        'deskripsi_rekomendasi' => $request->deskripsi_rekomendasi,
        'is_active'             => 1, // ✅ selalu aktif saat dibuat
    ]);

    return redirect()->route('admin.master-rekomendasi.index')
        ->with('success', 'Master rekomendasi berhasil ditambahkan.');
}

    public function edit($id)
    {
        $masterRekomendasi = MasterRekomendasi::findOrFail($id);

        $kategoriOptions = ['Tinggi', 'Sedang', 'Rendah'];

        $faktorOptions = [
            'Nilai Rata Rata Akademik',
            'Ketidak hadiran',
            'Pekerjaan orang tua',
            'Pendidikan Orang Tua',
        ];

        return view('admin.master_rekomendasi.edit', compact('masterRekomendasi', 'kategoriOptions', 'faktorOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_risiko' => 'required|in:Tinggi,Sedang,Rendah',
            'faktor_dominan' => 'required|in:Nilai Rata Rata Akademik,Ketidak hadiran,Pekerjaan orang tua,Pendidikan Orang Tua',
            'deskripsi_rekomendasi' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $masterRekomendasi = MasterRekomendasi::findOrFail($id);
        $masterRekomendasi->update([
            'kategori_risiko' => $request->kategori_risiko,
            'faktor_dominan' => $request->faktor_dominan,
            'deskripsi_rekomendasi' => $request->deskripsi_rekomendasi,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.master-rekomendasi.index')
            ->with('success', 'Master rekomendasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $masterRekomendasi = MasterRekomendasi::findOrFail($id);
        $masterRekomendasi->delete();

        return redirect()->route('admin.master-rekomendasi.index')
            ->with('success', 'Master rekomendasi berhasil dihapus.');
    }
}