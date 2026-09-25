<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'name_bn', 'type', 'medium', 'level', 'eiin', 'registration_no',
        'logo', 'favicon', 'phone', 'phone_alt', 'email', 'website',
        'address', 'city', 'district', 'division', 'postal_code',
        'principal_name', 'principal_phone', 'established_date',
        'motto', 'social_links', 'is_active',
    ];

    protected $casts = [
        'social_links' => 'array',
        'established_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function users() { return $this->hasMany(User::class); }
    public function academicYears() { return $this->hasMany(AcademicYear::class); }
    public function classes() { return $this->hasMany(SchoolClass::class); }
    public function subjects() { return $this->hasMany(Subject::class); }
    public function students() { return $this->hasMany(Student::class); }
    public function teachers() { return $this->hasMany(Teacher::class); }
    public function notices() { return $this->hasMany(Notice::class); }
    public function settings() { return $this->hasMany(Setting::class); }

    // Helper: Get current academic year
    public function getCurrentAcademicYearAttribute()
    {
        return $this->academicYears()->where('is_current', true)->first();
    }
}