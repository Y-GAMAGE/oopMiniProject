<?php
// filepath: d:\Programming\oop\MiniProject\oopMiniProject\app\Http\Controllers\RestaurantController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Attraction;
use App\Models\Country;
use App\Models\District;
use App\Models\Category;

class RestaurantController extends Controller
{
    public function nearAttraction($countrySlug, $districtSlug, $categorySlug, $attractionSlug)
    {
        $country = Country::where('slug', $countrySlug)->firstOrFail();
        $district = District::where('slug', $districtSlug)->where('country_id', $country->id)->firstOrFail();
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $attraction = Attraction::where('slug', $attractionSlug)
            ->where('district_id', $district->id)
            ->where('category_id', $category->id)
            ->firstOrFail();

        // Check if attraction has coordinates
        if (!$attraction->latitude || !$attraction->longitude) {
            return back()->with('error', 'Attraction coordinates not available');
        }

        // Get all restaurants in the district with coordinates
        $allRestaurants = Restaurant::where('district_id', $district->id)
            ->where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        // Calculate distance for each restaurant
        $restaurantsWithDistance = $allRestaurants->map(function ($restaurant) use ($attraction) {
            $distance = $this->calculateDistance(
                $attraction->latitude,
                $attraction->longitude,
                $restaurant->latitude,
                $restaurant->longitude
            );

            $restaurant->distance_from_attraction = $distance * 1000; // Convert km to meters

            // Calculate walk time (average walking speed: 80 meters per minute)
            $restaurant->walk_time_minutes = ceil($restaurant->distance_from_attraction / 80);

            return $restaurant;
        });

        // Filter by max distance (default 1km = 1000 meters)
        $maxDistance = request('distance', 1) * 1000; // Convert km to meters
        $filteredRestaurants = $restaurantsWithDistance->filter(function ($restaurant) use ($maxDistance) {
            return $restaurant->distance_from_attraction <= $maxDistance;
        });

        // Apply other filters
        $filteredRestaurants = $this->applyFilters($filteredRestaurants, request());

        // Sort by distance
        $filteredRestaurants = $filteredRestaurants->sortBy('distance_from_attraction')->values();

        // Manual pagination
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $total = $filteredRestaurants->count();
        $items = $filteredRestaurants->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $restaurants = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // Build active filters
        $activeFilters = $this->buildActiveFilters(request());

        return view('restaurants.near-attraction', compact(
            'restaurants',
            'attraction',
            'country',
            'district',
            'category',
            'activeFilters'
        ));
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Returns distance in km
    }

    private function applyFilters($restaurants, $request)
    {
        $filtered = $restaurants;

        // Filter by type
        if ($request->has('type') && !empty($request->type)) {
            $filtered = $filtered->whereIn('type', $request->type);
        }

        // Filter by cuisine
        if ($request->has('cuisine') && !empty($request->cuisine)) {
            $filtered = $filtered->filter(function ($restaurant) use ($request) {
                $cuisines = $restaurant->cuisine_type ?? [];
                return !empty(array_intersect($cuisines, $request->cuisine));
            });
        }

        // Filter by price range
        if ($request->has('price_range') && !empty($request->price_range)) {
            $filtered = $filtered->whereIn('price_range', $request->price_range);
        }

        // Filter by open now
        if ($request->has('open_now')) {
            $filtered = $filtered->filter(fn($r) => method_exists($r, 'isOpenNow') && $r->isOpenNow());
        }

        // Filter by features
        if ($request->has('features') && !empty($request->features)) {
            foreach ($request->features as $feature) {
                $filtered = $filtered->filter(function($r) use ($feature) {
                    return in_array($feature, $r->facilities ?? []);
                });
            }
        }

        return $filtered;
    }

    private function buildActiveFilters($request)
    {
        $filters = [];

        if ($request->has('distance')) {
            $filters[] = ['label' => 'Within ' . $request->distance . 'km', 'param' => 'distance'];
        }

        if ($request->has('type')) {
            foreach ($request->type as $type) {
                $filters[] = ['label' => ucfirst(str_replace('_', ' ', $type)), 'param' => 'type'];
            }
        }

        if ($request->has('cuisine')) {
            foreach ($request->cuisine as $cuisine) {
                $filters[] = ['label' => $cuisine, 'param' => 'cuisine'];
            }
        }

        if ($request->has('price_range')) {
            foreach ($request->price_range as $range) {
                $label = $range == 1 ? 'Budget' : ($range == 2 ? 'Moderate' : 'Upscale');
                $filters[] = ['label' => $label, 'param' => 'price_range'];
            }
        }

        if ($request->has('open_now')) {
            $filters[] = ['label' => 'Open Now', 'param' => 'open_now'];
        }

        return $filters;
    }
}
