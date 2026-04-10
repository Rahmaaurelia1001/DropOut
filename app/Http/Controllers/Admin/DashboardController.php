<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\PeriodePenilaian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();
    $totalKelas = Kelas::count();
    $totalSiswa = Siswa::count();
    $totalKriteria = Kriteria::count();
    $totalSubkriteria = Subkriteria::count();
    $totalPeriode = PeriodePenilaian::count();

    $siswaTerbaru = Siswa::orderBy('id_siswa', 'desc')->take(6)->get();

    // Data Diagram User
    $dataUserRoles = [
        User::where('role', 'admin')->count(),
        User::where('role', 'wali_kelas')->count(),
        User::where('role', 'kepsek')->count(),
    ];

    // Data Diagram Kriteria & Subkriteria
    $kriteriaData = Kriteria::withCount('subkriteria')->get();
    $labelsKriteria = $kriteriaData->pluck('nama_kriteria');
    $countSubkriteria = $kriteriaData->pluck('subkriteria_count');

    // Data Diagram Periode Status
    $dataPeriodeStatus = [
        PeriodePenilaian::where('status', 'aktif')->count(),
        PeriodePenilaian::where('status', 'nonaktif')->count(),
    ];

    return view('admin.dashboard', compact(
        'totalUsers', 'totalKelas', 'totalSiswa', 'totalKriteria', 
        'totalSubkriteria', 'totalPeriode', 'siswaTerbaru',
        'dataUserRoles', 'labelsKriteria', 'countSubkriteria', 'dataPeriodeStatus'
    ));
}
}