<?php

namespace App\Http\Controllers;

use App\Models\PeriodePenilaian;
use Illuminate\Http\Request;

class PeriodePenilaianController extends Controller
{
    public function index()
    {
        $periode = PeriodePenilaian::all();
        return view('periode.index', compact('periode'));
    }

    public function create()
    {
        return view('periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'status' => 'required'
        ]);

        if ($request->status == 'aktif') {
            PeriodePenilaian::where('status','aktif')
                ->update(['status' => 'nonaktif']);
        }

        PeriodePenilaian::create($request->all());

        return redirect()->route('periode.index')
            ->with('success','Periode berhasil ditambahkan');
    }

    public function edit($id)
    {
        $periode = PeriodePenilaian::findOrFail($id);
        return view('periode.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'status' => 'required'
        ]);

        if ($request->status == 'aktif') {
            PeriodePenilaian::where('status','aktif')
                ->where('id_periode','!=',$id)
                ->update(['status' => 'nonaktif']);
        }

        $periode = PeriodePenilaian::findOrFail($id);
        $periode->update($request->all());

        return redirect()->route('periode.index')
            ->with('success','Periode berhasil diupdate');
    }

    public function destroy($id)
    {
        PeriodePenilaian::findOrFail($id)->delete();

        return redirect()->route('periode.index')
            ->with('success','Periode berhasil dihapus');
    }
}