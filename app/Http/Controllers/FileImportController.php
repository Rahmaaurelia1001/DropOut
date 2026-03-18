<?php

namespace App\Http\Controllers;

use App\Models\PeriodePenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NilaiMapelImport;
use App\Imports\RaporImport;

class FileImportController extends Controller
{
    public function index()
    {
        $imports = DB::table('file_import')
            ->where('uploaded_by', Auth::id())
            ->orderBy('id_file', 'desc')
            ->get();

        $periodeAktif = PeriodePenilaian::where('status', 'Aktif')->first();

        return view('walas.import.index', compact('imports', 'periodeAktif'));
    }

    public function create()
    {
        $periodeAktif = PeriodePenilaian::where('status', 'Aktif')->first();

        if (!$periodeAktif) {
            return redirect()->route('walas.import.index')
                ->with('error', 'Belum ada periode penilaian yang aktif. Silakan hubungi admin.');
        }

        return view('walas.import.create', compact('periodeAktif'));
    }

    public function preview(Request $request)
    {
        $periodeAktif = PeriodePenilaian::where('status', 'Aktif')->first();

        if (!$periodeAktif) {
            return redirect()->route('walas.import.index')
                ->with('error', 'Belum ada periode penilaian yang aktif. Silakan hubungi admin.');
        }

        $request->validate([
            'jenis_data' => 'required|in:nilai_mapel,evaluasi',
            'file_excel' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file_excel');

        $tempName = 'preview_' . time() . '_' . $file->getClientOriginalName();
        $tempPath = $file->storeAs('temp_imports', $tempName, 'public');

        session([
            'preview_file_path' => $tempPath,
            'preview_file_name' => $file->getClientOriginalName(),
            'preview_jenis_data' => $request->jenis_data,
            'preview_id_periode' => $periodeAktif->id_periode,
        ]);

        $fullPath = storage_path('app/public/' . $tempPath);
        $data = Excel::toArray([], $fullPath);
        $rows = $data[0] ?? [];

        return view('walas.import.preview', [
            'rows' => $rows,
            'jenis_data' => $request->jenis_data,
            'periodeAktif' => $periodeAktif,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_data' => 'required|in:nilai_mapel,evaluasi',
        ]);

        $periodeAktif = PeriodePenilaian::where('status', 'Aktif')->first();

        if (!$periodeAktif) {
            return redirect()->route('walas.import.index')
                ->with('error', 'Belum ada periode penilaian yang aktif. Silakan hubungi admin.');
        }

        $tempPath = session('preview_file_path');
        $originalName = session('preview_file_name');
        $jenisData = session('preview_jenis_data');
        $idPeriode = session('preview_id_periode');

        if (!$tempPath || !$originalName || !$jenisData || !$idPeriode) {
            return redirect()->route('walas.import.create')
                ->with('error', 'Session preview import tidak ditemukan. Silakan upload ulang file.');
        }

        $fullTempPath = storage_path('app/public/' . $tempPath);

        if (!file_exists($fullTempPath)) {
            return redirect()->route('walas.import.create')
                ->with('error', 'File preview tidak ditemukan. Silakan upload ulang file.');
        }

        $namaFile = time() . '_' . $originalName;
        $finalPath = 'imports/' . $namaFile;

        Storage::disk('public')->copy($tempPath, $finalPath);

        $idFile = DB::table('file_import')->insertGetId([
            'nama_file' => $namaFile,
            'jenis_data' => $jenisData,
            'tanggal_upload' => now(),
            'uploaded_by' => Auth::id(),
            'file_path' => $finalPath,
        ]);

        if ($jenisData == 'nilai_mapel') {
            Excel::import(new NilaiMapelImport($idFile, $idPeriode), $fullTempPath);
        } elseif ($jenisData == 'evaluasi') {
            Excel::import(new RaporImport($idFile, $idPeriode), $fullTempPath);
        }

        Storage::disk('public')->delete($tempPath);

        session()->forget([
            'preview_file_path',
            'preview_file_name',
            'preview_jenis_data',
            'preview_id_periode',
        ]);

        return redirect()->route('walas.import.index')
            ->with('success', 'File berhasil diupload dan disimpan pada periode aktif.');
    }
}