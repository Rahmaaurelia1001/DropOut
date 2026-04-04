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
        'nama_kriteria' => 'required|string|max:255',
        'bobot' => 'required|numeric|min:0|max:1',
    ]);

    $bobotBaru = (float) $request->bobot;
    $totalBobot = \App\Models\Kriteria::sum('bobot');

    if (($totalBobot + $bobotBaru) > 1) {
        return back()
            ->withInput()
            ->with('error', 'Total bobot kriteria tidak boleh lebih dari 1.');
    }

    \App\Models\Kriteria::create([
        'nama_kriteria' => $request->nama_kriteria,
        'bobot' => $bobotBaru,
    ]);

    return redirect()->route('admin.kriteria.index')
        ->with('success', 'Data kriteria berhasil ditambahkan.');
}


    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_kriteria' => 'required|string|max:255',
        'bobot' => 'required|numeric|min:0|max:1',
    ]);

    $kriteria = \App\Models\Kriteria::findOrFail($id);
    $bobotBaru = (float) $request->bobot;

    $totalBobotSelainIni = \App\Models\Kriteria::where('id_kriteria', '!=', $kriteria->id_kriteria)
        ->sum('bobot');

    if (($totalBobotSelainIni + $bobotBaru) > 1) {
        return back()
            ->withInput()
            ->with('error', 'Total bobot kriteria tidak boleh lebih dari 1.');
    }

    $kriteria->update([
        'nama_kriteria' => $request->nama_kriteria,
        'bobot' => $bobotBaru,
    ]);

    return redirect()->route('admin.kriteria.index')
        ->with('success', 'Data kriteria berhasil diperbarui.');
}

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Data kriteria berhasil dihapus');
    }

    public function viewKepsek()
{
    $kriteria = \App\Models\Kriteria::orderBy('id_kriteria')->get();

    return view('kepsek.kriteria.index', compact('kriteria'));
}
}