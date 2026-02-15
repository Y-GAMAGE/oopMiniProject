<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attraction;
use App\Models\SavedPlace;

class UserDashboardController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show user dashboard
     */
    public function index()
    {
        $user = Auth::user();

        // Get user statistics - temporarily use dummy data
        $stats = [
            'total_trips' => 0, //
            'saved_places' => SavedPlace::where('user_id', $user->id)->count(),
            'reviews_count' => 0, // Will be implemented later
        ];



        // Get upcoming trips - empty for now
        $upcomingTrips = collect([]);

        // Get saved places (latest 3)
         $savedPlaces = SavedPlace::where('user_id', $user->id)
            ->with('saveable')
            ->latest()
            ->take(3)
            ->get();

        // Get recent activity
        $recentActivity = $this->getRecentActivity($user);

        // Get recommended places with relationships loaded
        $recommendedPlaces = Attraction::with(['district.country', 'category'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('user.dashboard', compact(
            'user',
            'stats',
            'upcomingTrips',
            'savedPlaces',
            'recentActivity',
            'recommendedPlaces'
        ));
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Show user settings
     */
    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }

    /**
     * Show user trips (placeholder for future implementation)
     */
    public function trips()
    {
        $user = Auth::user();
        $trips = collect([]); // Empty collection for now

        return view('user.trips', compact('user', 'trips'));
    }

    public function saved(Request $request)
    {
        $user = Auth::user();
        $type = $request->get('type', 'all');

        $query = $user->savedPlaces()->with('saveable');

        if ($type !== 'all') {
            $saveableType = "App\\Models\\" . ucfirst($type);
            $query->where('saveable_type', $saveableType);
        }

        $savedPlaces = $query->latest()->paginate(12);

        return view('user.saved', compact('user', 'savedPlaces', 'type'));
    }

    /**
     * Show user reviews (placeholder for future implementation)
     */
    public function reviews()
    {
        $user = Auth::user();
        $reviews = collect([]); // Empty collection for now

        return view('user.reviews', compact('user', 'reviews'));
    }

    /**
     * Get recent activity for user (will be implemented when models are ready)
     */
    private function getRecentActivity($user)
    {
        $activity = [];

        // Get recent saved places
        $recentSaves = $user->savedPlaces()
            ->with('saveable')
            ->latest()
            ->take(5)
            ->get();

        foreach ($recentSaves as $save) {
            $place = $save->saveable;
            if ($place) {
                $activity[] = [
                    'icon' => '❤️',
                    'text' => "Saved {$place->name}",
                    'time' => $save->created_at->diffForHumans(),
                ];
            }
        }

        return $activity;
    }

}
