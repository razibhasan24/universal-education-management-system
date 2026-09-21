<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            if ($user && $user->hasRole('super_admin')) {
                return true;
            }

            return null;
        });

        Gate::define('has-permission', function ($user, $permission) {
            return $user && $user->hasPermission($permission);
        });
    }
}
