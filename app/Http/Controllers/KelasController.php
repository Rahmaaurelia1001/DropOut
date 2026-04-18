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
            'nama_kelas'   => 'required|unique:kelas,nama_kelas',
            'tahun_ajaran' => 'required'
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique'   => 'Kelas ini sudah terdaftar, gunakan nama kelas yang berbeda.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.'
        ]);

        Kelas::create([
            'nama_kelas'   => $request->nama_kelas,
            'tahun_ajaran' => $request->tahun_ajaran
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas'   => 'required|unique:kelas,nama_kelas,' . $id . ',id_kelas',
            'tahun_ajaran' => 'required'
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique'   => 'Kelas ini sudah terdaftar, gunakan nama kelas yang berbeda.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.'
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas'   => $request->nama_kelas,
            'tahun_ajaran' => $request->tahun_ajaran
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}