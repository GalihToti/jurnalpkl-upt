<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrakerinController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\BerandaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('prakerin', PrakerinController::class);
Route::get('/laporan-prakerin/print', [PrakerinController::class, 'printLaporan'])->name('prakerin.print');

Route::resource('jurnal', JurnalController::class);
Route::get('/laporan-jurnal/print', [JurnalController::class, 'printLaporan'])->name('jurnal.print');

// Halaman beranda menggunakan welcome.blade.php
Route::get('/', [BerandaController::class, 'index'])->name('home');

// Route untuk API get siswa by NIS (TAMBAHKAN INI)
Route::get('/get-siswa-by-nis/{nis}', [PrakerinController::class, 'getSiswaByNis'])->name('get.siswa');
