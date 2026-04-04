<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\PeriodePenilaianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileImportController;
use App\Http\Controllers\MfepController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\MasterRekomendasiController;

/*
|--------------------------------------------------------------------------
| DEFAULT ROUTE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| REDIRECT SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect('/redirect');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROLE REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/redirect', function () {
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if (Auth::user()->role == 'wali_kelas') {
        return redirect()->route('walas.dashboard');
    }

    if (Auth::user()->role == 'kepsek') {
        return redirect()->route('kepsek.dashboard');
    }

    abort(403);
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Import siswa
        Route::get('/siswa/import', [SiswaController::class, 'importForm'])->name('siswa.import.form');
        Route::post('/siswa/import', [SiswaController::class, 'importStore'])->name('siswa.import.store');

        // Master data
        Route::resource('user', UserController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('kriteria', KriteriaController::class);
        Route::resource('subkriteria', SubkriteriaController::class);
        Route::resource('periode', PeriodePenilaianController::class);
        Route::resource('mapel', \App\Http\Controllers\MataPelajaranController::class);
        Route::resource('master-rekomendasi', MasterRekomendasiController::class)->except(['show']);
    });

/*
|--------------------------------------------------------------------------
| WALI KELAS AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:wali_kelas'])
    ->prefix('walas')
    ->name('walas.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('walas.dashboard');
        })->name('dashboard');

        // Import data
        Route::get('/import', [FileImportController::class, 'index'])->name('import.index');
        Route::post('/import/preview', [FileImportController::class, 'preview'])->name('import.preview');
        Route::get('/import/create', [FileImportController::class, 'create'])->name('import.create');
        Route::post('/import', [FileImportController::class, 'store'])->name('import.store');

        // MFEP
        Route::get('/mfep', [MfepController::class, 'index'])->name('mfep.index');
        Route::post('/mfep/proses', [MfepController::class, 'proses'])->name('mfep.proses');
        Route::get('/mfep/hasil', [MfepController::class, 'hasil'])->name('mfep.hasil');

        // Riwayat
        Route::get('/riwayat-analisis', [MfepController::class, 'riwayat'])->name('riwayat');

        // Update status rekomendasi
        Route::patch('/rekomendasi/{id}/status', [RekomendasiController::class, 'updateStatus'])
            ->name('rekomendasi.updateStatus');
    });

/*
|--------------------------------------------------------------------------
| KEPALA SEKOLAH AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:kepsek'])
    ->prefix('kepsek')
    ->name('kepsek.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('kepsek.dashboard');
        })->name('dashboard');

        Route::get('/bobot-kriteria', [KriteriaController::class, 'viewKepsek'])
        ->name('kriteria.index');

        // Hasil perhitungan / hasil analisis
        Route::get('/hasil-perhitungan', [MfepController::class, 'hasil'])->name('mfep.hasil');

        // Ranking risiko
        Route::get('/ranking-risiko', [MfepController::class, 'ranking'])->name('ranking');

        // Laporan SPK
       Route::get('/laporan-spk', [MfepController::class, 'laporan'])->name('laporan');
        Route::get('/laporan-spk/export-pdf', [MfepController::class, 'exportLaporanPdf'])
            ->name('laporan.exportPdf');

        // Pilih rekomendasi final
        Route::post('/pilih-rekomendasi', [MfepController::class, 'pilihRekomendasi'])
            ->name('pilih.rekomendasi');
    });

/*
|--------------------------------------------------------------------------
| PROFILE (BREEZE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';