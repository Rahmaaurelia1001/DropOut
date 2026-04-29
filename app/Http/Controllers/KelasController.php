<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
{
    $kelas = Kelas::orderByRaw("CAST(REGEXP_REPLACE(nama_kelas, '[^0-9]', '') AS UNSIGNED) ASC")
        ->orderByRaw("REGEXP_REPLACE(nama_kelas, '[0-9]', '') ASC")
        ->get();
    return view('kelas.index', compact('kelas'));
}

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'level_kelas'  => 'required|integer|between:1,6',
        'huruf_kelas'  => 'required|alpha|max:1',
        'tahun_ajaran' => 'required'
    ], [
        'level_kelas.required'  => 'Tingkatan kelas wajib dipilih.',
        'huruf_kelas.required'  => 'Huruf kelas wajib dipilih.',
        'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.'
    ]);

    $namaKelas = $request->level_kelas . strtoupper($request->huruf_kelas);

    // Cek duplikat
    if (Kelas::where('nama_kelas', $namaKelas)->exists()) {
        return back()->withErrors(['huruf_kelas' => 'Kelas ' . $namaKelas . ' sudah terdaftar.'])->withInput();
    }

    Kelas::create([
        'nama_kelas'   => $namaKelas,
        'tahun_ajaran' => $request->tahun_ajaran,
        'level_kelas'  => $request->level_kelas,
    ]);

    return redirect()->route('admin.kelas.index')
        ->with('success', 'Kelas ' . $namaKelas . ' berhasil ditambahkan.');
}

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'level_kelas'  => 'required|integer|between:1,6',
        'huruf_kelas'  => 'required|alpha|max:1',
        'tahun_ajaran' => 'required'
    ], [
        'level_kelas.required'  => 'Tingkatan kelas wajib dipilih.',
        'huruf_kelas.required'  => 'Huruf kelas wajib dipilih.',
        'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.'
    ]);

    $namaKelas = $request->level_kelas . strtoupper($request->huruf_kelas);

    // Cek duplikat kecuali diri sendiri
    if (Kelas::where('nama_kelas', $namaKelas)->where('id_kelas', '!=', $id)->exists()) {
        return back()->withErrors(['huruf_kelas' => 'Kelas ' . $namaKelas . ' sudah terdaftar.'])->withInput();
    }

    $kelas = Kelas::findOrFail($id);
    $kelas->update([
        'nama_kelas'   => $namaKelas,
        'tahun_ajaran' => $request->tahun_ajaran,
        'level_kelas'  => $request->level_kelas,
    ]);

    return redirect()->route('admin.kelas.index')
        ->with('success', 'Kelas ' . $namaKelas . ' berhasil diperbarui.');
}

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}