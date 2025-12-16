<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ArsipController;

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

// Route admin arsip
Route::get('/admin/arsip', [ArsipController::class, 'index'])->name('admin.arsip');
Route::post('/admin/arsip/restore', [ArsipController::class, 'restore'])->name('admin.arsip.restore');
Route::post('/admin/arsip/destroy', [ArsipController::class, 'destroy'])->name('admin.arsip.destroy');

// Menuju Halaman Kontrol Admin
Route::get('/admin/kontrol-admin', function () {
    return view('admin.kontrol-admin');
})->name('admin.kontrol-admin');
