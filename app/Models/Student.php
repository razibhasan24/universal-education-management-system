<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'institution_id', 'student_id', 'name_bn', 'name_en',
        'gender', 'dob', 'birth_certificate_no', 'religion', 'blood_group', 'nationality',
        'father_name', 'father_occupation', 'father_nid', 'father_phone',
        'mother_name', 'mother_occupation', 'mother_nid', 'mother_phone',
        'guardian_name', 'guardian_relation', 'guardian_phone', 'guardian_occupation',
        'present_address', 'permanent_address', 'photo', 'signature',
        'admission_date', 'status',
    ];

    protected $casts = [
        'dob' => 'date',
        'admission_date' => 'date',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function institution() { return $this->belongsTo(Institution::class); }
    public function academics() { return $this->hasMany(StudentAcademic::class); }
    public function currentAcademic() { return $this->hasOne(StudentAcademic::class)->where('is_current', true); }
    public function attendances() { return $this->hasMany(StudentAttendance::class); }
    public function examMarks() { return $this->hasMany(ExamMark::class); }
    public function feePayments() { return $this->hasMany(FeePayment::class); }

    // Accessor: পুরো নাম
    public function getFullNameAttribute() { return $this->name_bn; }

    // Helper: বয়স
    public function getAgeAttribute()
    {
        return $this->dob?->age;
    }

    // Auto Student ID generate
    public static function generateStudentId($institutionId)
    {
        $year = now()->year;
        $prefix = "STD-{$year}-";
        $last = static::where('institution_id', $institutionId)
            ->where('student_id', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        $number = $last ? ((int) substr($last->student_id, -5)) + 1 : 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}