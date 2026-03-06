<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\PeriodePenilaian;

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

        $siswaTerbaru = Siswa::orderBy('id_siswa', 'desc')->take(5)->get();
        $periodeTerbaru = PeriodePenilaian::orderBy('id_periode', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalKelas',
            'totalSiswa',
            'totalKriteria',
            'totalSubkriteria',
            'totalPeriode',
            'siswaTerbaru',
            'periodeTerbaru'
        ));
    }
}