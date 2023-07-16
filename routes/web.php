<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlusterisasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Kmeans;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ScatterPlotController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/home');
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Home
Route::get("/home", [HomeController::class, 'index'])->name("home");
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Profil
Route::resource('profile', ProfilController::class);

// Dataset
Route::resource('dataset', DatasetController::class);

//Dosen
Route::resource('dosen', DosenController::class);

//Nilai
Route::get('nilai', [NilaiController::class, 'index']);
Route::post('nilai/download_excel', [NilaiController::class, 'download_excel']);

//Klusterisasi
Route::resource('perhitungan', KlusterisasiController::class);
Route::get('/hasil-kmeans', [KlusterisasiController::class,'hasil']);
Route::get('/hasil-kmeans/detail/{id}', [KlusterisasiController::class, 'detail']);
//Laporan
Route::resource('history', HistoryController::class);


Route::get("/pw", function() {

    echo password_hash( "123", PASSWORD_DEFAULT );
});


Route::get("/hitung", [Kmeans::class, 'index']);
Route::post('/kmeans/manual', [Kmeans::class, 'hitung_manual'])->name('kynan');
Route::get('/kmeans/random', [Kmeans::class, 'hitung_random']);

Route::get('/scatter-plot', [ScatterPlotController::class, 'index'])->name('scatter.plot');

Route::get('/dataset', [Kmeans::class,'dataset']);

Route::post('/nilai/import_excel', [NilaiController::class, 'import_excel']);
Route::get('/nilai/export_excel', [NilaiController::class, 'export_excel']);