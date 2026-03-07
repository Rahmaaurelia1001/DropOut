<?php

namespace App\Http\Controllers;

use App\Models\PeriodePenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RaporImport;

class FileImportController extends Controller
{
    public function index()
    {
        $imports = DB::table('file_import')
            ->where('uploaded_by', Auth::id())
            ->orderBy('id_file', 'desc')
            ->get();

        return view('walas.import.index', compact('imports'));
    }

    public function create()
    {
        $periode = PeriodePenilaian::orderBy('id_periode', 'desc')->get();

        return view('walas.import.create', compact('periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_data' => 'required|in:rapor,presensi',
            'file_excel' => 'required|mimes:xlsx,xls',
        ]);

       $file = $request->file('file_excel');
$namaFile = time() . '_' . $file->getClientOriginalName();
$path = $file->storeAs('imports', $namaFile, 'public');

DB::table('file_import')->insert([
    'nama_file' => $namaFile,
    'jenis_data' => $request->jenis_data,
    'tanggal_upload' => now(),
    'uploaded_by' => Auth::id(),
    'file_path' => $path,
]);

if ($request->jenis_data == 'rapor') {
    Excel::import(new RaporImport, $file);
}

return redirect()->route('walas.import.index')
    ->with('success', 'File berhasil diupload dan disimpan.');
    }
}