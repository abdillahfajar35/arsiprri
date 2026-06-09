<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login-proses', [AuthController::class, 'prosesLogin']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/daftararsip', function () {
    return view('arsip.daftararsip');
})->middleware('auth');

Route::get('/daftararsippublik', function () {
    return view('arsip_publik.daftararsippublik');
})->middleware('auth');

Route::get('/inputarsip', [App\Http\Controllers\ArsipController::class, 'create'])->name('arsip.input');
Route::post('/arsip/simpan', [ArsipController::class, 'store'])->name('arsip.store');
Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');
Route::get('/daftararsip', [ArsipController::class, 'index'])->name('arsip.daftararsip');

Route::get('/arsip/{id}/edit', [App\Http\Controllers\ArsipController::class, 'edit'])->name('arsip.edit');
Route::put('/arsip/{id}', [App\Http\Controllers\ArsipController::class, 'update'])->name('arsip.update');
Route::delete('/arsip/{id}', [App\Http\Controllers\ArsipController::class, 'destroy'])->name('arsip.destroy');

Route::get('/verifikasiarsip', [App\Http\Controllers\ArsipController::class, 'antreanVerifikasi'])->name('arsip.antrean');
Route::put('/arsip/{id}/verifikasi', [App\Http\Controllers\ArsipController::class, 'prosesVerifikasi'])->name('arsip.verifikasi');
Route::get('/arsip-publik', [App\Http\Controllers\ArsipController::class, 'daftarArsipPublik'])->name('arsip.publik');

Route::get('/arsip/lihat/{id}', [ArsipController::class, 'lihatDokumen'])->name('arsip.lihat');
Route::get('/manajemen-akun', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::post('/manajemen-akun', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::put('/manajemen-akun/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/manajemen-akun/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
