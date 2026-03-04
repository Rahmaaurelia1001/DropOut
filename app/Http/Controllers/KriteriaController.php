<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric'
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')
            ->with('success','Data kriteria berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric'
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($request->all());

        return redirect()->route('kriteria.index')
            ->with('success','Data kriteria berhasil diupdate');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('kriteria.index')
            ->with('success','Data kriteria berhasil dihapus');
    }
}