<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\VisualisasiController;
use App\Http\Controllers\ForecastingController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\DataSampahController;
use App\Http\Controllers\DataSopirController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Auth\LoginController;




// Rute login custom
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('data-master')->name('data-master.')->group(function () {
        // Data User
        Route::get('/data-user', [DataMasterController::class, 'dataUser'])->name('data-user');


        Route::resource('data-sopir', DataSopirController::class)->names('data-sopir');

   
        Route::resource('data-sampah', DataSampahController::class)->names('data-sampah');
       
    });

    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/verifikasi-laporan', [LaporanController::class, 'verifikasiLaporan'])->name('verifikasi-laporan');
        Route::get('/bagikan-laporan', [LaporanController::class, 'bagikanLaporan'])->name('bagikan-laporan');
    });

    Route::get('/visualisasi', [VisualisasiController::class, 'index'])->name('visualisasi');
    Route::get('/visualisasi/pengguna', [VisualisasiController::class, 'pengguna'])->name('visualisasi.pengguna');
    Route::get('/forecasting', [ForecastingController::class, 'index'])->name('forecasting');

    Route::resource('riwayat-berita', BeritaController::class)->middleware('auth');

    // Tambah ini
    Route::prefix('layouts')->name('layouts.')->group(function () {
        Route::get('/without-menu', [LayoutController::class, 'withoutMenu'])->name('without-menu');
        Route::get('/without-navbar', [LayoutController::class, 'withoutNavbar'])->name('without-navbar');
        Route::get('/container', [LayoutController::class, 'container'])->name('container');
        Route::get('/fluid', [LayoutController::class, 'fluid'])->name('fluid');
        Route::get('/blank', [LayoutController::class, 'blank'])->name('blank');
    });



}); 