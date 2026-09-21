<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roles): bool
    {
        if (is_string($roles)) {
            $roles = explode(',', $roles);
        }

        return $this->roles->pluck('name')->intersect($roles)->isNotEmpty();
    }

    public function assignRole($role): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);
    }

    public function removeRole($role): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->detach($role);
    }

    protected $loadedPermissions;

    public function getAllPermissions(): Collection
    {
        if ($this->loadedPermissions === null) {
            $this->loadedPermissions = $this->roles()
                ->with('permissions')
                ->get()
                ->pluck('permissions')
                ->flatten(1)
                ->unique('id')
                ->values();
        }

        return $this->loadedPermissions;
    }

    public function hasPermission($permission): bool
    {
        $name = is_string($permission) ? $permission : $permission->name;

        return $this->getAllPermissions()->contains('name', $name);
    }

    public function hasAnyPermission(array|string $permissions): bool
    {
        foreach ((array) $permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}
