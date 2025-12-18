<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ArsipController;
use App\Http\Controllers\Admin\AdminController as FeAdminController;

Route::view('/', 'index')->name('home');

// Routes untuk authentication
Route::get('/auth/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Routes yang membutuhkan autentikasi
Route::middleware(['auth.admin'])->group(function () {
    // Route admin dashboard - boleh diakses admin dan viewer
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/filter', [DashboardController::class, 'filter'])->name('admin.dashboard.filter');

    // Laporan routes - viewer hanya bisa melihat
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');

    // Di routes/web.php di FE
    Route::middleware(['role'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.laporan');
            Route::post('/laporan/archive', [App\Http\Controllers\Admin\LaporanController::class, 'archive'])->name('admin.laporan.archive');
            Route::post('/laporan/destroy', [App\Http\Controllers\Admin\LaporanController::class, 'destroy'])->name('admin.laporan.destroy');
        });
    });

    // Arsip routes - viewer hanya bisa melihat
    Route::get('/admin/arsip', [ArsipController::class, 'index'])->name('admin.arsip');

    // Routes yang hanya boleh diakses admin
    Route::middleware(['role'])->group(function () {
        Route::post('/admin/arsip/restore', [ArsipController::class, 'restore'])->name('admin.arsip.restore');
        Route::post('/admin/arsip/destroy', [ArsipController::class, 'destroy'])->name('admin.arsip.destroy');
    });

    // Kontrol admin - viewer hanya bisa melihat
    Route::get('/admin/kontrol-admin', [FeAdminController::class, 'index'])->name('admin.kontrol-admin');

    // Routes yang hanya boleh diakses admin
    Route::middleware(['role'])->group(function () {
        Route::get('/admin/tambah-admin', function () {
            return view('admin.tambah-admin');
        })->name('admin.tambah');
    });
});

// API Routes untuk admin di FE (untuk AJAX calls)
Route::prefix('admin/api')->middleware(['auth.admin'])->group(function () {
    // Routes GET yang boleh diakses viewer
    Route::get('/admins', [FeAdminController::class, 'index'])->name('admin.api.admins');
    Route::get('/admins/{id}', [FeAdminController::class, 'show'])->name('admin.api.admins.show');

    // Routes yang hanya boleh diakses admin
    Route::middleware(['role'])->group(function () {
        Route::post('/admins', [FeAdminController::class, 'store'])->name('admin.api.store');
        Route::put('/admins/{id}', [FeAdminController::class, 'update'])->name('admin.api.update');
        Route::delete('/admins/{id}', [FeAdminController::class, 'destroy'])->name('admin.api.destroy');
        Route::post('/admins/delete-multiple', [FeAdminController::class, 'destroyMultiple'])->name('admin.api.destroyMultiple');
        Route::put('/admins/{id}/status', [FeAdminController::class, 'updateStatus'])->name('admin.api.updateStatus');
    });

    // Route untuk last-active yang boleh diakses semua
    Route::put('/admins/{id}/last-active', [FeAdminController::class, 'updateLastActive'])->name('admin.api.updateLastActive');
});
