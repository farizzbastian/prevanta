<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.landing')->name('landing');
Route::view('/login', 'pages.auth.login')->name('login');
Route::view('/register', 'pages.auth.register')->name('register');

Route::prefix('orang-tua')->name('parent.')->group(function (): void {
    Route::view('/anakku', 'pages.parent.children')->name('children');
    Route::view('/anak/profil', 'pages.parent.child-profile')->name('child-profile');
    Route::view('/riwayat-pengukuran', 'pages.parent.measurements')->name('measurements');
    Route::view('/riwayat-imunisasi', 'pages.parent.immunizations')->name('immunizations');
    Route::view('/edukasi', 'pages.parent.education')->name('education');
});

Route::prefix('kader')->name('kader.')->group(function (): void {
    Route::view('/dashboard', 'pages.kader.dashboard')->name('dashboard');
    Route::view('/monitoring', 'pages.kader.monitoring')->name('monitoring');
    Route::view('/balita/profil', 'pages.kader.child-profile')->name('child-profile');
    Route::view('/balita/tambah', 'pages.kader.add-child')->name('add-child');
    Route::view('/balita/pengukuran', 'pages.kader.measurement')->name('measurement');
    Route::view('/jadwal', 'pages.kader.schedule')->name('schedule');
    Route::view('/edukasi', 'pages.kader.education')->name('education');
    Route::view('/edukasi/tambah', 'pages.kader.add-education')->name('add-education');
});

Route::prefix('bidan')->name('bidan.')->group(function (): void {
    Route::view('/dashboard', 'pages.bidan.dashboard')->name('dashboard');
    Route::view('/riwayat', 'pages.bidan.history')->name('history');
    Route::view('/verifikasi', 'pages.bidan.verification')->name('verification');
    Route::view('/portal', 'pages.dashboard')->name('portal');
});
