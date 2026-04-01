<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect()->route('auth.login');
        }

        $userRole = Session::get('user.role');
        $currentRoute = $request->route()->getName();

        // 1. SUPER ADMIN: Raja terakhir, bisa akses APAPUN.
        if ($userRole === 'super_admin') {
            return $next($request);
        }

        // 2. ADMIN: Kelola Laporan, tapi hanya LIHAT Kontrol Admin.
        if ($userRole === 'admin') {
            // Daftar route yang dilarang keras untuk Admin (biasanya route POST/PUT/DELETE)
            $forbiddenForAdmin = [
                'admin.kontrol-admin.store',
                'admin.kontrol-admin.update',
                'admin.kontrol-admin.destroy',
            ];

            if (in_array($currentRoute, $forbiddenForAdmin)) {
                abort(403, 'Admin hanya boleh melihat daftar akun, tidak boleh mengelola.');
            }

            return $next($request);
        }

        // 3. VIEWER: Hanya Baca (Read-Only) di semua halaman.
        if ($userRole === 'viewer') {
            // Viewer hanya boleh akses route GET
            if (!$request->isMethod('get')) {
                abort(403, 'Viewer tidak diizinkan mengubah atau menambah data.');
            }

            // Daftar halaman yang boleh dibuka Viewer
            $allowedRoutes = [
                'admin.dashboard',
                'admin.laporan',
                'admin.arsip',
                'admin.kontrol-admin', // Bisa lihat daftar tapi tidak bisa klik simpan/hapus karena filter isMethod('get') di atas
            ];

            if (in_array($currentRoute, $allowedRoutes) || str_starts_with($currentRoute, 'admin.api')) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
