<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::view('/', 'index')->name('home');

// Menuju Halaman Login Admin
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('auth.login');

// Route admin dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dashboard/filter', [DashboardController::class, 'dashboardFilter'])->name('admin.dashboard.filter');

// Menuju Halaman Laporan Admin
Route::get('/admin/laporan', function () {
    return view('admin.laporan');
})->name('admin.laporan');

// Menuju Halaman Kontrol Admin
Route::get('/admin/kontrol-admin', function () {
    return view('admin.kontrol-admin');
})->name('admin.kontrol-admin');

// Menuju Halaman Arsip
Route::get('/admin/arsip', function () {
    return view('admin.arsip');
})->name('admin.arsip');
