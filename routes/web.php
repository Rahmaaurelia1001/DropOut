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

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Redirect Setelah Login (Breeze)
|--------------------------------------------------------------------------
| Breeze biasanya masuk ke /dashboard setelah login
| Kita arahkan dulu ke /redirect untuk cek role
*/

Route::get('/dashboard', function () {
    return redirect('/redirect');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Role Redirect
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
| WALIKELAS AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:wali_kelas'])->group(function () {

    Route::get('/walas/dashboard', function () {
        return view('walas.dashboard');
    })->name('walas.dashboard');

});

/*
|--------------------------------------------------------------------------
| KEPSEK AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:kepsek'])->group(function () {

    Route::get('/kepsek/dashboard', function () {
        return view('kepsek.dashboard');
    })->name('kepsek.dashboard');

});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('subkriteria', SubkriteriaController::class);
    Route::resource('periode', PeriodePenilaianController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
});

/*
|--------------------------------------------------------------------------
| PROFILE (Breeze Default)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';