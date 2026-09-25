<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['institution_id', 'key', 'value', 'type', 'group', 'label', 'description'];

    public static function get($key, $default = null, $institutionId = null)
    {
        $setting = static::where('key', $key)
            ->when($institutionId, fn($q) => $q->where('institution_id', $institutionId))
            ->first();

        return $setting?->value ?? $default;
    }

    public static function set($key, $value, $institutionId = null, $type = 'string', $group = 'general')
    {
        return static::updateOrCreate(
            ['key' => $key, 'institution_id' => $institutionId],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
    }
}