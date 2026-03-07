<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;

class SiswaController extends Controller
{
    public function index(Request $request)
{
    $kelasList = Kelas::all();

    $query = Siswa::with('kelas');

    if (Auth::user()->role == 'wali_kelas') {
        $query->where('id_kelas', Auth::user()->id_kelas);
    } else {
        if ($request->filled('id_kelas')) {
            $query->where('id_kelas', $request->id_kelas);
        }
    }

    $siswa = $query->get();

    return view('siswa.index', compact('siswa', 'kelasList'));
}

    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:Siswa,nisn',
            'nama_siswa' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'id_kelas' => 'required'
        ]);

        Siswa::create($request->all());

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();

        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    $request->validate([
        'nisn' => 'required|unique:Siswa,nisn,' . $id . ',id_siswa',
        'nama_siswa' => 'required',
        'jenis_kelamin' => 'nullable',
        'tanggal_lahir' => 'nullable',
        'id_kelas' => 'required'
    ]);

    $siswa->update([
        'nisn' => $request->nisn,
        'nama_siswa' => $request->nama_siswa,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_lahir' => $request->tanggal_lahir,
        'id_kelas' => $request->id_kelas,
    ]);

    return redirect()->route('admin.siswa.index')
        ->with('success', 'Data siswa berhasil diupdate');
}
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }

    public function importForm()
    {
    $kelas = \App\Models\Kelas::all();
    return view('siswa.import', compact('kelas'));
    }

public function importStore(Request $request)
{
    $request->validate([
        'id_kelas' => 'required',
        'file_excel' => 'required|mimes:xls,xlsx',
    ]);

    Excel::import(new SiswaImport($request->id_kelas), $request->file('file_excel'));
    dd('file excel siswa terbaca');
}
}