<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\KelasController;
Route::resource('kelas', KelasController::class);

use App\Http\Controllers\SiswaController;
Route::resource('siswa', SiswaController::class);

Route::resource('siswa', SiswaController::class);

use App\Http\Controllers\KriteriaController;
Route::resource('kriteria', KriteriaController::class);

use App\Http\Controllers\SubkriteriaController;
Route::resource('subkriteria', SubkriteriaController::class);

use App\Http\Controllers\PeriodePenilaianController;
Route::resource('periode', PeriodePenilaianController::class);