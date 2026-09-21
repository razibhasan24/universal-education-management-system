<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
