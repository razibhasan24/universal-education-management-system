<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions')->withTimestamps();
    }

    public function givePermissionTo($permission)
    {
        $permission = $this->resolvePermission($permission);

        $this->permissions()->syncWithoutDetaching($permission);

        return $this;
    }

    public function revokePermissionTo($permission)
    {
        $permission = $this->resolvePermission($permission);

        $this->permissions()->detach($permission);

        return $this;
    }

    public function hasPermission($permission)
    {
        $name = is_string($permission) ? $permission : $permission->name;

        return $this->permissions->contains('name', $name);
    }

    public function syncPermissions($permissions)
    {
        $names = collect($permissions)->map(function ($permission) {
            return is_string($permission) ? $permission : $permission->name;
        })->toArray();

        $permissionIds = Permission::whereIn('name', $names)->pluck('id');

        $this->permissions()->sync($permissionIds);

        return $this;
    }

    protected function resolvePermission($permission)
    {
        if (is_string($permission)) {
            return Permission::where('name', $permission)->firstOrFail();
        }

        return $permission;
    }
}
