<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class RoleHelper
{
    public static function isAdmin()
    {
        return Session::has('user') && Session::get('user.role') === 'admin';
    }

    public static function isViewer()
    {
        return Session::has('user') && Session::get('user.role') === 'viewer';
    }

    public static function getUserRole()
    {
        return Session::get('user.role', null);
    }

    public static function getUserName()
    {
        return Session::get('user.name', 'User');
    }

    public static function can($action)
    {
        if (!Session::has('user')) {
            return false;
        }

        $role = Session::get('user.role');

        // Admin bisa melakukan semua aksi
        if ($role === 'admin') {
            return true;
        }

        // Viewer hanya bisa melihat
        if ($role === 'viewer') {
            $readOnlyActions = ['view', 'index', 'show'];
            return in_array($action, $readOnlyActions);
        }

        return false;
    }
}
