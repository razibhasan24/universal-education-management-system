<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
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
=======

class Institution extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';

    public const STATUS_INACTIVE = 'inactive';

    public const TYPE_SCHOOL = 'school';

    public const TYPE_COLLEGE = 'college';

    public const TYPE_MADRASA = 'madrasa';

    public const TYPE_COACHING_CENTER = 'coaching_center';

    public const TYPE_TRAINING_CENTER = 'training_center';

    protected $fillable = [
        'name',
        'institution_type',
        'code',
        'eiin',
        'email',
        'phone',
        'address',
        'logo',
        'status',
    ];

    public static function types(): array
    {
        return [
            self::TYPE_SCHOOL,
            self::TYPE_COLLEGE,
            self::TYPE_MADRASA,
            self::TYPE_COACHING_CENTER,
            self::TYPE_TRAINING_CENTER,
        ];
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
        ];
    }

    public static function typeLabel(string $type): string
    {
        return ucfirst(str_replace('_', ' ', $type));
    }

    public static function statusLabel(string $status): string
    {
        return ucfirst($status);
    }
}
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
