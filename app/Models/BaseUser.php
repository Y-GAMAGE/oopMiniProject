<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

abstract class BaseUser extends Authenticatable
{
    use Notifiable;  // Removed HasApiTokens

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profile_picture',
        'country',
        'status',
        'role',
        'google_id',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Common methods
    public function getProfilePictureUrl(): string
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0071c2&color=fff';
    }

    public function getFullName(): string
    {
        return $this->name;
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function getBadgeColor(): string
    {
        return match($this->status) {
            'active' => 'success',
            'inactive' => 'secondary',
            'suspended' => 'danger',
            default => 'warning'
        };
    }

    // Abstract methods (polymorphism)
    abstract public function getDashboardRoute(): string;
    abstract public function getRole(): string;
    abstract public function canAccessAdminPanel(): bool;
    abstract public function redirectAfterLogin(): string;
}
