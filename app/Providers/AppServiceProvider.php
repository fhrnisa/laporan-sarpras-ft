<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrasi middleware
        $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\CheckAdminRole::class);
        $this->app['router']->aliasMiddleware('auth.admin', \App\Http\Middleware\AuthAdmin::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
