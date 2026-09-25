<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\StudentAttendance;
use App\Models\FeePayment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $institutionId = auth()->user()->institution_id;

        $stats = [
            'total_students' => Student::where('institution_id', $institutionId)->where('status', 'active')->count(),
            'total_teachers' => Teacher::where('institution_id', $institutionId)->where('status', 'active')->count(),
            'total_classes' => SchoolClass::where('institution_id', $institutionId)->where('is_active', true)->count(),
            'today_attendance' => StudentAttendance::where('institution_id', $institutionId)->where('date', today())->count(),
            'today_fee_collection' => FeePayment::where('institution_id', $institutionId)->where('payment_date', today())->sum('total_paid'),
            'this_month_fee' => FeePayment::where('institution_id', $institutionId)
                ->whereMonth('payment_date', now()->month)
                ->whereYear('payment_date', now()->year)
                ->sum('total_paid'),
        ];

        return view('dashboard', compact('stats'));
    }
}