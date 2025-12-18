<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AdminHelper
{
    public static function isAdmin()
    {
        if (Auth::check() && session()->has('user')) {
            return session('user.role') === 'admin';
        }
        return false;
    }

    public static function isViewer()
    {
        if (Auth::check() && session()->has('user')) {
            return session('user.role') === 'viewer';
        }
        return false;
    }

    public static function getUserRole()
    {
        return session('user.role') ?? null;
    }
}
