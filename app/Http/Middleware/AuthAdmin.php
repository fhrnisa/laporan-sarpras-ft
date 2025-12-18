<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek jika ada user di session
        if (!Session::has('user')) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}
