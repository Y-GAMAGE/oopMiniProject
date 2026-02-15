<?php

namespace App\Models;

class RegularUser extends BaseUser
{
    protected $table = 'users';

    // Relationships
    public function trips()
    {
        return $this->hasMany(Trip::class, 'user_id');
    }

    public function savedItems()
    {
        return $this->hasMany(SavedItem::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    // Polymorphic implementations
    public function getDashboardRoute(): string
    {
        return route('user.dashboard');
    }

    public function getRole(): string
    {
        return 'user';
    }

    public function canAccessAdminPanel(): bool
    {
        return false;
    }

    public function redirectAfterLogin(): string
    {
        return $this->getDashboardRoute();
    }

    // User-specific methods
    public function getTotalTrips(): int
    {
        return $this->trips()->count();
    }

    public function getTotalSavedPlaces(): int
    {
        return $this->savedItems()->count();
    }

    public function getTotalReviews(): int
    {
        return $this->reviews()->count();
    }
}
