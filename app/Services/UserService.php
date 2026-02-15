<?php

namespace App\Services;

use App\Models\BaseUser;
use App\Models\RegularUser;
use App\Models\AdminUser;
use App\Models\User;

class UserService
{
    public function getUserInstance(User $user): BaseUser
    {
        return match($user->role) {
            'admin' => new AdminUser($user->toArray()),
            'user' => new RegularUser($user->toArray()),
            default => new RegularUser($user->toArray())
        };
    }

    public function redirectToDashboard(BaseUser $user): string
    {
        return $user->getDashboardRoute();
    }

    public function checkAdminAccess(BaseUser $user): bool
    {
        return $user->canAccessAdminPanel();
    }

    public function getWelcomeMessage(BaseUser $user): string
    {
        return match($user->getRole()) {
            'admin' => "Welcome back, {$user->getFullName()}! Manage your platform.",
            'user' => "Welcome back, {$user->getFullName()}! Ready for your next adventure?",
            default => "Welcome, {$user->getFullName()}!"
        };
    }

    public function getUserStatistics(BaseUser $user): array
    {
        if ($user instanceof AdminUser) {
            return [
                'total_users' => User::where('role', 'user')->count(),
                'total_attractions' => \App\Models\Attraction::count(),
                'pending_reviews' => \App\Models\Review::where('status', 'pending')->count(),
                'actions_today' => $user->getTotalActionsToday(),
            ];
        }

        if ($user instanceof RegularUser) {
            return [
                'total_trips' => $user->getTotalTrips(),
                'saved_places' => $user->getTotalSavedPlaces(),
                'reviews' => $user->getTotalReviews(),
            ];
        }

        return [];
    }
}
