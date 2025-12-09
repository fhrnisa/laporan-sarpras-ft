<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'index')->name('home');

// Menuju Halaman Login Admin
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('auth.login');

// Route admin dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

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