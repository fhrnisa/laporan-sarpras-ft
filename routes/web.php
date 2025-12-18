<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ArsipController;
use App\Http\Controllers\Admin\AdminController as FeAdminController;

Route::view('/', 'index')->name('home');

// Menuju Halaman Login Admin
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('auth.login');

// Route admin dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dashboard/filter', [DashboardController::class, 'filter'])->name('admin.dashboard.filter');

// Laporan routes
Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
Route::post('/admin/laporan/archive', [LaporanController::class, 'archive'])->name('admin.laporan.archive');
Route::post('/admin/laporan/destroy', [LaporanController::class, 'destroy'])->name('admin.laporan.destroy');

// Arsip routes
Route::get('/admin/arsip', [ArsipController::class, 'index'])->name('admin.arsip');
Route::post('/admin/arsip/restore', [ArsipController::class, 'restore'])->name('admin.arsip.restore');
Route::post('/admin/arsip/destroy', [ArsipController::class, 'destroy'])->name('admin.arsip.destroy');

// Admin routes
Route::get('/admin/kontrol-admin', [FeAdminController::class, 'index'])->name('admin.kontrol-admin');
Route::get('/admin/tambah-admin', function () {
    return view('admin.tambah-admin');
})->name('admin.tambah');

// API Routes untuk admin di FE (untuk AJAX calls)
Route::prefix('admin/api')->group(function () {
    Route::get('/admins', [FeAdminController::class, 'index']);
    Route::post('/admins', [FeAdminController::class, 'store'])->name('admin.api.store');
    Route::get('/admins/{id}', [FeAdminController::class, 'show']);
    Route::put('/admins/{id}', [FeAdminController::class, 'update']);
    Route::delete('/admins/{id}', [FeAdminController::class, 'destroy']);
    Route::post('/admins/delete-multiple', [FeAdminController::class, 'destroyMultiple']);
    Route::put('/admins/{id}/status', [FeAdminController::class, 'updateStatus']);
    Route::put('/admins/{id}/last-active', [FeAdminController::class, 'updateLastActive']);
});
