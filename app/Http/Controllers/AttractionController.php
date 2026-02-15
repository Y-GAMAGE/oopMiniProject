<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\Country;
use App\Models\District;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Accommodation;
use Illuminate\Support\Facades\Auth;

class AttractionController extends Controller
{
    /**
     * Display a single attraction detail page
     */
    public function show($countrySlug, $districtSlug, $categorySlug, $attractionSlug)
    {
        // Get the country
        $country = Country::where('slug', $countrySlug)->firstOrFail();

        // Get the district
        $district = District::where('slug', $districtSlug)
            ->where('country_id', $country->id)
            ->firstOrFail();

        // Get the category
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Get the attraction with relationships
        $attraction = Attraction::where('slug', $attractionSlug)
            ->where('district_id', $district->id)
            ->where('category_id', $category->id)
            ->with(['reviews' => function($query) {
                $query->orderBy('created_at', 'desc')->limit(10);
            }])
            ->firstOrFail();

        // Check if user has saved this attraction
        $isSaved = false;
        if (Auth::check()) {
            $isSaved = Auth::user()->hasSaved('App\\Models\\Attraction', $attraction->id);
        }

        // Get nearby restaurants (within 5km)
        $nearbyRestaurants = $attraction->nearbyRestaurants(3);

        // Get nearby accommodations (within 5km)
        $nearbyAccommodations = $attraction->nearbyAccommodations(3);

        // Get similar attractions (same category, same district, exclude current)
        $similarAttractions = $attraction->nearbyAttractions(4);

        // Get weather data (you can integrate with weather API later)
        $weather = $this->getCurrentWeather($attraction->latitude, $attraction->longitude);

        // Get opening hours
        $openingHours = $attraction->getOpeningHours();

        // Get facility icons
        $facilities = $attraction->getFacilityIcons();

        // Calculate rating distribution
        $ratingDistribution = $this->getRatingDistribution($attraction);

        // Generate Google Maps directions URL
        $googleMapsUrl = $this->getGoogleMapsUrl($attraction);

        return view('attractions.show', compact(
            'country',
            'district',
            'category',
            'attraction',
            'isSaved',
            'nearbyRestaurants',
            'nearbyAccommodations',
            'similarAttractions',
            'weather',
            'openingHours',
            'facilities',
            'ratingDistribution',
            'googleMapsUrl'
        ));
    }

    public function showBySlug($slug)
    {
        $attraction = Attraction::where('slug', $slug)
            ->with(['district.country', 'category'])
            ->firstOrFail();

        return $this->show(
            $attraction->district->country->slug,
            $attraction->district->slug,
            $attraction->category->slug,
            $slug
        );
    }

    /**
     * Get Google Maps directions URL
     */
    private function getGoogleMapsUrl($attraction)
    {
        if ($attraction->latitude && $attraction->longitude) {
            return "https://www.google.com/maps/dir/?api=1&destination={$attraction->latitude},{$attraction->longitude}";
        } elseif ($attraction->address || $attraction->location) {
            $address = urlencode($attraction->address ?? $attraction->location);
            return "https://www.google.com/maps/search/?api=1&query={$address}";
        }

        return null;
    }

    /**
     * Get current weather (placeholder - integrate with weather API)
     */
    private function getCurrentWeather($latitude, $longitude)
    {
        // TODO: Integrate with OpenWeatherMap API or similar
        // For now, return mock data
        return [
            'temperature' => 26,
            'condition' => 'Partly Cloudy',
            'icon' => '⛅',
            'humidity' => 75,
            'wind_speed' => 12,
        ];
    }

    /**
     * Calculate rating distribution for reviews
     */
    private function getRatingDistribution($attraction)
    {
        if ($attraction->reviews_count == 0) {
            return [
                '5' => 0,
                '4' => 0,
                '3' => 0,
                '2' => 0,
                '1' => 0,
            ];
        }

        // Mock distribution based on overall rating
        // In production, calculate from actual reviews
        $distribution = [
            '5' => 68,
            '4' => 22,
            '3' => 7,
            '2' => 2,
            '1' => 1,
        ];

        return $distribution;
    }
}
