<?php
// filepath: d:\Programming\oop\MiniProject\oopMiniProject\app\Http\Controllers\AccommodationController.php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Attraction;
use App\Models\Country;
use App\Models\District;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccommodationController extends Controller
{
    /**
     * Show accommodations near an attraction
     */
    public function nearAttraction(Request $request, $country, $district, $category, $attraction)
    {
        // Debug logging
        Log::info('AccommodationController nearAttraction called', [
            'country' => $country,
            'district' => $district,
            'category' => $category,
            'attraction' => $attraction,
        ]);

        // Find models
        try {
            $countryModel = Country::where('slug', $country)->firstOrFail();
            $districtModel = District::where('slug', $district)->where('country_id', $countryModel->id)->firstOrFail();
            $categoryModel = Category::where('slug', $category)->firstOrFail();
            $attractionModel = Attraction::where('slug', $attraction)
                ->where('district_id', $districtModel->id)
                ->where('category_id', $categoryModel->id)
                ->firstOrFail();
        } catch (\Exception $e) {
            Log::error('Error finding models: ' . $e->getMessage());
            return back()->with('error', 'Attraction not found');
        }

        Log::info('Attraction found', [
            'name' => $attractionModel->name,
            'lat' => $attractionModel->latitude,
            'lng' => $attractionModel->longitude,
        ]);

        // Check if attraction has coordinates
        if (!$attractionModel->latitude || !$attractionModel->longitude) {
            Log::warning('Attraction has no coordinates');

            // TEMPORARY: Show all accommodations without distance calculation
            $accommodations = Accommodation::where('district_id', $districtModel->id)
                ->where('is_active', true)
                ->paginate(12);

            return view('accommodations.near-attraction', [
                'attraction' => $attractionModel,
                'category' => $categoryModel,
                'district' => $districtModel,
                'country' => $countryModel,
                'accommodations' => $accommodations,
                'distanceReferences' => [
                    'within_1km' => 0,
                    '1_to_3km' => 0,
                    '3_to_5km' => 0,
                    '5plus_km' => $accommodations->total(),
                ],
                'filters' => [
                    'max_distance' => 10,
                    'property_types' => [],
                    'min_price' => 0,
                    'max_price' => 50000,
                    'star_ratings' => [],
                    'facilities' => [],
                ],
            ]);
        }

        // Get all accommodations in the district with coordinates
        $allAccommodations = Accommodation::where('district_id', $districtModel->id)
            ->where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        Log::info('Accommodations found: ' . $allAccommodations->count());

        // If no accommodations found, show message
        if ($allAccommodations->isEmpty()) {
            return view('accommodations.near-attraction', [
                'attraction' => $attractionModel,
                'category' => $categoryModel,
                'district' => $districtModel,
                'country' => $countryModel,
                'accommodations' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12),
                'distanceReferences' => [
                    'within_1km' => 0,
                    '1_to_3km' => 0,
                    '3_to_5km' => 0,
                    '5plus_km' => 0,
                ],
                'filters' => [
                    'max_distance' => 10,
                    'property_types' => [],
                    'min_price' => 0,
                    'max_price' => 50000,
                    'star_ratings' => [],
                    'facilities' => [],
                ],
            ]);
        }

        // Calculate distance for each accommodation
        $accommodationsWithDistance = $allAccommodations->map(function ($accommodation) use ($attractionModel) {
            $distance = $this->calculateDistance(
                $attractionModel->latitude,
                $attractionModel->longitude,
                $accommodation->latitude,
                $accommodation->longitude
            );

            $accommodation->distance_from_attraction = $distance; // in km
            return $accommodation;
        });

        Log::info('Distance calculated for accommodations');

        // Filter by max distance (default 10km)
        $maxDistance = $request->input('max_distance', 10);
        $filteredAccommodations = $accommodationsWithDistance->filter(function ($accommodation) use ($maxDistance) {
            return $accommodation->distance_from_attraction <= $maxDistance;
        });

        Log::info('Filtered accommodations: ' . $filteredAccommodations->count() . ' within ' . $maxDistance . 'km');

        // Apply other filters
        $filteredAccommodations = $this->applyFilters($filteredAccommodations, $request);

        // Sort by distance
        $filteredAccommodations = $filteredAccommodations->sortBy('distance_from_attraction')->values();

        // Calculate distance references
        $distanceRefs = [
            'within_1km' => $accommodationsWithDistance->filter(fn($a) => $a->distance_from_attraction <= 1)->count(),
            '1_to_3km' => $accommodationsWithDistance->filter(fn($a) => $a->distance_from_attraction > 1 && $a->distance_from_attraction <= 3)->count(),
            '3_to_5km' => $accommodationsWithDistance->filter(fn($a) => $a->distance_from_attraction > 3 && $a->distance_from_attraction <= 5)->count(),
            '5plus_km' => $accommodationsWithDistance->filter(fn($a) => $a->distance_from_attraction > 5 && $a->distance_from_attraction <= 20)->count(),
        ];

        // Manual pagination
        $perPage = 12;
        $currentPage = $request->get('page', 1);
        $total = $filteredAccommodations->count();
        $items = $filteredAccommodations->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $accommodations = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        Log::info('Returning view with ' . $accommodations->count() . ' accommodations');

        return view('accommodations.near-attraction', [
            'attraction' => $attractionModel,
            'category' => $categoryModel,
            'district' => $districtModel,
            'country' => $countryModel,
            'accommodations' => $accommodations,
            'distanceReferences' => $distanceRefs,
            'filters' => [
                'max_distance' => $maxDistance,
                'property_types' => $request->input('property_types', []),
                'min_price' => $request->input('min_price', 0),
                'max_price' => $request->input('max_price', 50000),
                'star_ratings' => $request->input('star_ratings', []),
                'facilities' => $request->input('facilities', []),
            ],
        ]);
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

    /**
     * Apply filters to accommodations
     */
    private function applyFilters($accommodations, $request)
    {
        $filtered = $accommodations;

        // Filter by property type
        if ($request->has('property_types') && !empty($request->property_types)) {
            $filtered = $filtered->whereIn('type', $request->property_types);
        }

        // Filter by price range
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 999999);
        $filtered = $filtered->filter(function($acc) use ($minPrice, $maxPrice) {
            return $acc->price_per_night >= $minPrice && $acc->price_per_night <= $maxPrice;
        });

        // Filter by star rating
        if ($request->has('star_ratings') && !empty($request->star_ratings)) {
            $filtered = $filtered->filter(function($acc) use ($request) {
                return in_array($acc->star_rating, $request->star_ratings);
            });
        }

        // Filter by facilities
        if ($request->has('facilities') && !empty($request->facilities)) {
            foreach ($request->facilities as $facility) {
                $filtered = $filtered->filter(function($acc) use ($facility) {
                    return in_array($facility, $acc->facilities ?? []);
                });
            }
        }

        return $filtered;
    }
}
