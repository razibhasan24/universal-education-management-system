<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    use HasFactory;

    public const TYPE_COMPULSORY = 'compulsory';
    public const TYPE_OPTIONAL = 'optional';
    public const TYPE_PRACTICAL = 'practical';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'institution_id',
        'class_id',
        'name',
        'code',
        'full_marks',
        'pass_marks',
        'subject_type',
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

    public static function types(): array
    {
        return [
            self::TYPE_COMPULSORY,
            self::TYPE_OPTIONAL,
            self::TYPE_PRACTICAL,
        ];
    }

    public static function typeLabel(string $type): string
    {
        return match ($type) {
            self::TYPE_COMPULSORY => 'Compulsory',
            self::TYPE_OPTIONAL => 'Optional',
            self::TYPE_PRACTICAL => 'Practical',
            default => ucfirst($type),
        };
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

    public function scopeCompulsory($query)
    {
        return $query->where('subject_type', self::TYPE_COMPULSORY);
    }

    public function scopeOptional($query)
    {
        return $query->where('subject_type', self::TYPE_OPTIONAL);
    }

    public function scopePractical($query)
    {
        return $query->where('subject_type', self::TYPE_PRACTICAL);
    }
}
