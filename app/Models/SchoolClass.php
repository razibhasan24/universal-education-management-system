<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'institution_id', 'name', 'name_bn', 'numeric_value',
        'level', 'group', 'order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function institution() { return $this->belongsTo(Institution::class); }
    public function sections() { return $this->hasMany(Section::class, 'class_id'); }
    public function subjects() { return $this->belongsToMany(Subject::class, 'class_subjects', 'class_id', 'subject_id'); }
    public function classSubjects() { return $this->hasMany(ClassSubject::class, 'class_id'); }
    public function studentAcademics() { return $this->hasMany(StudentAcademic::class, 'class_id'); }
}
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolClass extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    protected $table = 'school_classes';

    protected $fillable = [
        'institution_id',
        'academic_session_id',
        'name',
        'code',
        'numeric_order',
        'status',
    ];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
        ];
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
            default => ucfirst($status),
        };
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeForInstitution($query, int $institutionId)
    {
        return $query->where('institution_id', $institutionId);
    }

    public function scopeForSession($query, int $sessionId)
    {
        return $query->where('academic_session_id', $sessionId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('numeric_order')->orderBy('name');
    }
}
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
