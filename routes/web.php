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
});


/*
|--------------------------------------------------------------------------
| WALIKELAS AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:wali_kelas'])
    ->prefix('walas')
    ->name('walas.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('walas.dashboard');
        })->name('dashboard');

        Route::get('/import', [FileImportController::class, 'index'])->name('import.index');
        Route::post('/import/preview', [FileImportController::class, 'preview'])->name('import.preview');
        Route::get('/import/create', [FileImportController::class, 'create'])->name('import.create');
        Route::post('/import', [FileImportController::class, 'store'])->name('import.store');
});


/*
|--------------------------------------------------------------------------
| KEPSEK AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:kepsek'])
    ->prefix('kepsek')
    ->name('kepsek.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('kepsek.dashboard');
        })->name('dashboard');
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