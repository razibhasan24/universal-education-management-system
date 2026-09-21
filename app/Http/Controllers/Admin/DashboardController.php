<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = 0; // Student::count();
        $teachersCount = 0; // Teacher::count();
        $classesCount = 0; // SschoolClass::count();
        $pendingFees = 0; // Fee::where('status', 'pending')->count();

        $recentActivity = new Collection;

        return view('admin.dashboard', compact(
            'studentsCount',
            'teachersCount',
            'classesCount',
            'pendingFees',
            'recentActivity'
        ));
    }
}
