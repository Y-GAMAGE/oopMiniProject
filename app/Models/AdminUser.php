<?php

namespace App\Models;

class AdminUser extends BaseUser
{
    protected $table = 'users';

    // Polymorphic implementations
    public function getDashboardRoute(): string
    {
        return route('admin.dashboard');
    }

    public function getRole(): string
    {
        return 'admin';
    }

    public function canAccessAdminPanel(): bool
    {
        return true;
    }

    public function redirectAfterLogin(): string
    {
        return $this->getDashboardRoute();
    }

    // Admin-specific methods
    public function canManageUsers(): bool
    {
        return $this->isActive();
    }

    public function canModerateReviews(): bool
    {
        return $this->isActive();
    }
}
