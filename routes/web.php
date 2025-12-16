<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ArsipController;
use App\Http\Controllers\Admin\AdminController;

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
Route::post('/admin/laporan/archive', [LaporanController::class, 'archive'])->name('admin.laporan.archive');

// Route admin arsip
Route::get('/admin/arsip', [ArsipController::class, 'index'])->name('admin.arsip');
Route::post('/admin/arsip/restore', [ArsipController::class, 'restore'])->name('admin.arsip.restore');
Route::post('/admin/arsip/destroy', [ArsipController::class, 'destroy'])->name('admin.arsip.destroy');

// Route admin kontrol-admin
Route::get('/admin/kontrol-admin', [AdminController::class, 'index'])->name('admin.kontrol-admin');

// API Routes untuk admin di FE (untuk AJAX calls)
Route::prefix('admin/api')->group(function () {
    Route::get('/admins', [AdminController::class, 'index']);
    Route::post('/admins', [AdminController::class, 'store']);
    Route::get('/admins/{id}', [AdminController::class, 'show']);
    Route::put('/admins/{id}', [AdminController::class, 'update']);
    Route::delete('/admins/{id}', [AdminController::class, 'destroy']);
    Route::post('/admins/delete-multiple', [AdminController::class, 'destroyMultiple']);
    Route::put('/admins/{id}/status', [AdminController::class, 'updateStatus']);
    Route::put('/admins/{id}/last-active', [AdminController::class, 'updateLastActive']);
});
