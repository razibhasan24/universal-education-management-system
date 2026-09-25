<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'institution_id', 'employee_id', 'name_bn', 'name_en',
        'gender', 'dob', 'religion', 'blood_group', 'nid',
        'phone', 'phone_alt', 'email', 'designation', 'department',
        'qualification', 'specialization', 'salary', 'joining_date',
        'employment_type', 'present_address', 'permanent_address',
        'photo', 'signature', 'status',
    ];

    protected $casts = [
        'dob' => 'date',
        'joining_date' => 'date',
        'salary' => 'decimal:2',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function institution() { return $this->belongsTo(Institution::class); }
    public function attendances() { return $this->hasMany(TeacherAttendance::class); }

    public static function generateEmployeeId($institutionId)
    {
        $year = now()->year;
        $prefix = "EMP-{$year}-";
        $last = static::where('institution_id', $institutionId)
            ->where('employee_id', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        $number = $last ? ((int) substr($last->employee_id, -4)) + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}