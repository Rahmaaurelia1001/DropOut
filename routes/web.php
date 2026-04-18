<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import Controllers
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
use App\Http\Controllers\WalasController; // Tambahkan ini
use App\Http\Controllers\MataPelajaranController;
use Illuminate\Support\Facades\DB;
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
        Route::resource('mapel', MataPelajaranController::class);
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

        // Dashboard (Sekarang terhubung ke Controller untuk Chart)
        Route::get('/dashboard', [WalasController::class, 'dashboard'])->name('dashboard');

        // Import data
        Route::get('/import', [FileImportController::class, 'index'])->name('import.index');
        Route::get('/import/create', [FileImportController::class, 'create'])->name('import.create');
        Route::post('/import/preview', [FileImportController::class, 'preview'])->name('import.preview');
        Route::post('/import', [FileImportController::class, 'store'])->name('import.store');

        // MFEP
        Route::get('/mfep', [MfepController::class, 'index'])->name('mfep.index');
        Route::post('/mfep/proses', [MfepController::class, 'proses'])->name('mfep.proses');
        Route::get('/mfep/hasil', [MfepController::class, 'hasil'])->name('mfep.hasil');

        // Riwayat
        Route::get('/riwayat-analisis', [MfepController::class, 'riwayat'])->name('riwayat');

        // Pilih rekomendasi final
        Route::post('/rekomendasi/hasil/{id}/status', [RekomendasiController::class, 'updateStatus'])
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

        Route::get('/dashboard', [MfepController::class, 'dashboardKepsek'])->name('dashboard');

        Route::get('/bobot-kriteria', [KriteriaController::class, 'viewKepsek'])
            ->name('kriteria.index');

        Route::get('/hasil-perhitungan', [MfepController::class, 'hasil'])
            ->name('mfep.hasil');

        Route::get('/ranking-risiko', [MfepController::class, 'ranking'])
            ->name('ranking');

        Route::get('/laporan-spk', [MfepController::class, 'laporan'])
            ->name('laporan');

        Route::get('/laporan-spk/export-pdf', [MfepController::class, 'exportLaporanPdf'])
            ->name('laporan.exportPdf');

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

// Log Activity (shared semua role)
Route::middleware('auth')->group(function () {
    Route::get('/log-activities', function () {
        $logs = DB::table('log_activities')
            ->join('users', 'log_activities.user_id', '=', 'users.id')
            ->select('log_activities.*', 'users.name as nama_user')
            ->when(auth()->user()->role === 'wali_kelas', function ($q) {
                $q->where('log_activities.user_id', auth()->id());
            })
            ->orderBy('log_activities.created_at', 'desc')
            ->limit(20)
            ->get();

        return response()->json($logs);
    })->name('log.activities');
});

require __DIR__.'/auth.php';