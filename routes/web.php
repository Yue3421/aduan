<?php

use App\Http\Controllers\Auth\MasyarakatAuthController;
use App\Http\Controllers\Auth\PetugasAuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

// Routes untuk masyarakat
Route::get('/register', [MasyarakatAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [MasyarakatAuthController::class, 'register']);
Route::get('/login', [MasyarakatAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MasyarakatAuthController::class, 'login']);
Route::post('/logout', [MasyarakatAuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('masyarakat.dashboard');
    })->name('dashboard');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
});

// Routes untuk petugas
Route::get('/petugas/register', [PetugasAuthController::class, 'showRegisterForm'])->name('petugas.register');
Route::post('/petugas/register', [PetugasAuthController::class, 'register']);
Route::get('/petugas/login', [PetugasAuthController::class, 'showLoginForm'])->name('petugas.login');
Route::post('/petugas/login', [PetugasAuthController::class, 'login']);
Route::post('/petugas/logout', [PetugasAuthController::class, 'logout'])->name('petugas.logout');

Route::middleware('auth:petugas')->group(function () {
    Route::get('/petugas/dashboard', [PetugasController::class, 'dashboard'])->name('petugas.dashboard');
    Route::post('/petugas/pengaduan/{id_pengaduan}/status', [PetugasController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::post('/petugas/pengaduan/{id_pengaduan}/tanggapan', [PetugasController::class, 'storeTanggapan'])->name('pengaduan.storeTanggapan');
    Route::get('/petugas/laporan', function () {
        if (!auth('petugas')->check() || auth('petugas')->user()->level !== 'admin') {
            abort(403, 'Akses ditolak. Anda tidak memiliki peran yang sesuai.');
        }
        return (new PetugasController())->generateLaporan();
    })->name('petugas.laporan');
});