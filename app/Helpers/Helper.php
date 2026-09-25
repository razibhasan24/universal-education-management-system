<?php

namespace App\Helpers;

use App\Models\Setting;

class Helper
{
    /**
     * Active menu check
     */
    public static function isActive($route, $class = 'active')
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r) || request()->routeIs($r . '.*')) {
                    return $class;
                }
            }
            return '';
        }

        return request()->routeIs($route) || request()->routeIs($route . '.*') ? $class : '';
    }

    /**
     * Is menu open (has active child)
     */
    public static function isMenuOpen(array $routes): bool
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route) || request()->routeIs($route . '.*')) {
                return true;
            }
        }
        return false;
    }

    /**
     * Format money in BDT
     */
    public static function money($amount, $symbol = '৳')
    {
        return $symbol . ' ' . number_format($amount, 2);
    }

    /**
     * Format date in Bengali
     */
    public static function bnDate($date)
    {
        if (!$date) return '-';
        return \Carbon\Carbon::parse($date)->format('d M, Y');
    }

    /**
     * Bangla number converter
     */
    public static function bnNumber($number)
    {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, $number);
    }

    /**
     * Get setting value
     */
    public static function setting($key, $default = null)
    {
        return Setting::get($key, $default, auth()->user()?->institution_id);
    }

    /**
     * User avatar URL
     */
    public static function avatar($user = null)
    {
        $user = $user ?? auth()->user();
        if ($user?->photo) {
            return asset('storage/' . $user->photo);
        }
        $name = urlencode($user?->name ?? 'U');
        return "https://ui-avatars.com/api/?name={$name}&background=4f46e5&color=fff&size=128";
    }

    /**
     * Get initials from name
     */
    public static function initials($name)
    {
        $words = explode(' ', trim($name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials ?: 'U';
    }

    /**
     * Status badge color
     */
    public static function statusColor($status)
    {
        return match ($status) {
            'active', 'present', 'approved', 'paid', 'posted', 'published' => 'green',
            'inactive', 'absent', 'rejected', 'cancelled', 'failed' => 'red',
            'pending', 'late', 'draft' => 'yellow',
            'leave', 'half_day' => 'blue',
            default => 'gray',
        };
    }
}
