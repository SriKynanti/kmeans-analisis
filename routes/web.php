<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlusterisasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Kmeans;
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
    return view('layouts/landingpage');
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

//Klusterisasi
Route::resource('perhitungan', KlusterisasiController::class);
Route::get('/hasil', function () {
    return view('klasterisasi/hasilperhitungan');
});
//Laporan
Route::resource('laporan', LaporanController::class);


Route::get("/pw", function() {

    echo password_hash( "123", PASSWORD_DEFAULT );
});


Route::get("/hitung", [Kmeans::class, 'index']);