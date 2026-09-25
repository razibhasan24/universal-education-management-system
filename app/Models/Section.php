<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616

class Section extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['class_id', 'name', 'name_bn', 'capacity', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function schoolClass() { return $this->belongsTo(SchoolClass::class, 'class_id'); }
    public function studentAcademics() { return $this->hasMany(StudentAcademic::class); }
}
=======
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'institution_id',
        'class_id',
        'name',
        'capacity',
        'status',
    ];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
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

    public function scopeForClass($query, int $classId)
    {
        return $query->where('class_id', $classId);
    }
}
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
