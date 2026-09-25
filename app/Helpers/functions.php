<?php

use App\Helpers\Helper;

if (!function_exists('is_active')) {
    function is_active($route, $class = 'active') {
        return Helper::isActive($route, $class);
    }
}

if (!function_exists('is_menu_open')) {
    function is_menu_open(array $routes): bool {
        return Helper::isMenuOpen($routes);
    }
}

if (!function_exists('money')) {
    function money($amount, $symbol = '৳') {
        return Helper::money($amount, $symbol);
    }
}

if (!function_exists('bn_number')) {
    function bn_number($number) {
        return Helper::bnNumber($number);
    }
}

if (!function_exists('avatar_url')) {
    function avatar_url($user = null) {
        return Helper::avatar($user);
    }
}

if (!function_exists('user_can')) {
    function user_can(string $permission): bool {
        return auth()->check() && auth()->user()->can($permission);
    }
}

if (!function_exists('user_has_role')) {
    function user_has_role($roles): bool {
        return auth()->check() && auth()->user()->hasAnyRole((array) $roles);
    }
}