<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Bidan\DashboardController as BidanDashboardController;
use App\Http\Controllers\Bidan\HistoryController as BidanHistoryController;
use App\Http\Controllers\Bidan\PortalController;
use App\Http\Controllers\Bidan\VerificationController;
use App\Http\Controllers\Kader\BalitaController;
use App\Http\Controllers\Kader\DashboardController as KaderDashboardController;
use App\Http\Controllers\Kader\EdukasiController as KaderEdukasiController;
use App\Http\Controllers\Kader\JadwalController;
use App\Http\Controllers\Kader\PengukuranController;
use App\Http\Controllers\Parent\ChildController;
use App\Http\Controllers\Parent\EducationController as ParentEducationController;
use App\Http\Controllers\Parent\ImmunizationHistoryController;
use App\Http\Controllers\Parent\MeasurementHistoryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.landing')->name('landing');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('throttle:login')->name('login.store');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:orang_tua'])->prefix('orang-tua')->name('parent.')->group(function (): void {
    Route::get('/anakku', [ChildController::class, 'index'])->name('children');
    Route::get('/anak/{balita}', [ChildController::class, 'show'])->name('child-profile');
    Route::get('/riwayat-pengukuran', [MeasurementHistoryController::class, 'index'])->name('measurements');
    Route::get('/riwayat-imunisasi', [ImmunizationHistoryController::class, 'index'])->name('immunizations');
    Route::get('/edukasi', [ParentEducationController::class, 'index'])->name('education');
});

Route::middleware(['auth', 'role:kader'])->prefix('kader')->name('kader.')->group(function (): void {
    Route::get('/dashboard', KaderDashboardController::class)->name('dashboard');
    Route::get('/monitoring', [BalitaController::class, 'index'])->name('monitoring');
    Route::get('/balita/tambah', [BalitaController::class, 'create'])->name('add-child');
    Route::post('/balita', [BalitaController::class, 'store'])->name('children.store');
    Route::get('/balita/{balita}', [BalitaController::class, 'show'])->name('child-profile');
    Route::get('/balita/{balita}/pengukuran', [PengukuranController::class, 'create'])->name('measurement');
    Route::post('/balita/{balita}/pengukuran', [PengukuranController::class, 'store'])->name('measurements.store');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('schedule');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('schedules.store');
    Route::get('/edukasi', [KaderEdukasiController::class, 'index'])->name('education');
    Route::get('/edukasi/tambah', [KaderEdukasiController::class, 'create'])->name('add-education');
    Route::post('/edukasi', [KaderEdukasiController::class, 'store'])->name('education.store');
});

Route::middleware(['auth', 'role:bidan'])->prefix('bidan')->name('bidan.')->group(function (): void {
    Route::get('/dashboard', BidanDashboardController::class)->name('dashboard');
    Route::get('/riwayat', [BidanHistoryController::class, 'index'])->name('history');
    Route::get('/verifikasi/{pengukuran?}', [VerificationController::class, 'show'])->name('verification');
    Route::post('/verifikasi/{pengukuran}', [VerificationController::class, 'store'])->name('verification.store');
    Route::get('/portal', PortalController::class)->name('portal');
});
