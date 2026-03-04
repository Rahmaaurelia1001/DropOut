<?php

namespace App\Http\Controllers;

use App\Models\Subkriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function index()
    {
        $subkriteria = Subkriteria::with('kriteria')->get();
        return view('subkriteria.index', compact('subkriteria'));
    }

    public function create()
    {
        $kriteria = Kriteria::all();
        return view('subkriteria.create', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required',
            'nama_subkriteria' => 'required',
            'nilai_skala' => 'required|numeric'
        ]);

        Subkriteria::create($request->all());

        return redirect()->route('subkriteria.index')
            ->with('success','Data subkriteria berhasil ditambahkan');
    }

    public function edit($id)
    {
        $subkriteria = Subkriteria::findOrFail($id);
        $kriteria = Kriteria::all();

        return view('subkriteria.edit', compact('subkriteria','kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kriteria' => 'required',
            'nama_subkriteria' => 'required',
            'nilai_skala' => 'required|numeric'
        ]);

        $subkriteria = Subkriteria::findOrFail($id);
        $subkriteria->update($request->all());

        return redirect()->route('subkriteria.index')
            ->with('success','Data subkriteria berhasil diupdate');
    }

    public function destroy($id)
    {
        Subkriteria::findOrFail($id)->delete();

        return redirect()->route('subkriteria.index')
            ->with('success','Data subkriteria berhasil dihapus');
    }
}