<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;

Route::view('/', 'index')->name('home');

// Menuju Halaman Login Admin
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('auth.login');

// Route admin dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dashboard/filter', [DashboardController::class, 'filter'])->name('admin.dashboard.filter');

// Route admin laporan
Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');

// Menuju Halaman Kontrol Admin
Route::get('/admin/kontrol-admin', function () {
    return view('admin.kontrol-admin');
})->name('admin.kontrol-admin');

// Menuju Halaman Arsip
Route::get('/admin/arsip', function () {
    return view('admin.arsip', [
        'laporan' => []
    ]);
})->name('admin.arsip');

