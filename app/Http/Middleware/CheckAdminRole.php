<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        // Cek session user (karena kita simpan data user dari BE di session)
        if (!Session::has('user')) {
            return redirect()->route('auth.login');
        }

        // Ambil role dari session
        $userRole = Session::get('user.role');

        // Admin bisa akses semua
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Viewer hanya bisa akses route tertentu
        if ($userRole === 'viewer') {
            $allowedRoutes = [
                'admin.dashboard',
                'admin.dashboard.filter',
                'admin.laporan',
                'admin.arsip',
                'admin.kontrol-admin'
            ];

            $currentRoute = $request->route()->getName();

            // Viewer bisa akses jika route ada di daftar allowed
            if (in_array($currentRoute, $allowedRoutes)) {
                return $next($request);
            }

            // Untuk route API/view detail, kita perlu cek pattern
            if (preg_match('/^admin\.api\.admins$/', $currentRoute) ||
                preg_match('/^admin\.api\.admins\.show$/', $currentRoute)) {
                return $next($request);
            }
        }

        // Jika tidak diizinkan
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini');
    }
}
