<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicSession extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_UPCOMING = 'upcoming';
    public const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'institution_id',
        'name',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
            self::STATUS_UPCOMING,
            self::STATUS_COMPLETED,
        ];
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_UPCOMING => 'Upcoming',
            self::STATUS_COMPLETED => 'Completed',
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

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isCurrent(): bool
    {
        $today = now()->toDateString();
        return $this->start_date->toDateString() <= $today
            && $this->end_date->toDateString() >= $today;
    }

    public static function getActiveSession(int $institutionId): ?self
    {
        return self::where('institution_id', $institutionId)
            ->where('status', self::STATUS_ACTIVE)
            ->first();
    }
}
