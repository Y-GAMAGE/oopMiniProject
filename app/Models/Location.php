<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class Location extends Model
{
    // Common properties for all locations
    protected $fillable = [
        'district_id',
        'name',
        'slug',
        'description',
        'image_url',
        'images',
        'rating',
        'reviews_count',
        'phone',
        'email',
        'website',
        'address',
        'location',
        'latitude',
        'longitude',
        'tags',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'reviews_count' => 'integer',
        'images' => 'array',
        'tags' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Abstract method - must be implemented by children
    abstract public function getLocationType(): string;

    // Generate Google Maps URL
    public function getMapUrl(): string
    {
        if (!$this->latitude || !$this->longitude) {
            return '#';
        }
        return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
    }

    // Calculate distance between two points (Haversine formula)
    public function calculateDistance($lat2, $lon2): float
    {
        if (!$this->latitude || !$this->longitude) {
            return 0;
        }

        $earthRadius = 6371; // km

        $latFrom = deg2rad($this->latitude);
        $lonFrom = deg2rad($this->longitude);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }

    // Calculate distance from another location
    public function distanceFrom(Location $location): float
    {
        return $this->calculateDistance($location->latitude, $location->longitude);
    }

    // Get formatted distance
    public function getFormattedDistance($lat, $lon): string
    {
        $distance = $this->calculateDistance($lat, $lon);

        if ($distance < 1) {
            return round($distance * 1000) . ' m';
        }
        return $distance . ' km';
    }

    // Get formatted distance from another location
    public function getFormattedDistanceFrom(Location $location): string
    {
        return $this->getFormattedDistance($location->latitude, $location->longitude);
    }

    // Scope for nearby locations
    public function scopeNearby($query, $latitude, $longitude, $radius = 10)
    {
        $haversine = "(6371 * acos(cos(radians(?))
                     * cos(radians(latitude))
                     * cos(radians(longitude) - radians(?))
                     + sin(radians(?))
                     * sin(radians(latitude))))";

        return $query
            ->select('*')
            ->selectRaw("{$haversine} AS distance", [$latitude, $longitude, $latitude])
            ->whereRaw("{$haversine} < ?", [$latitude, $longitude, $latitude, $radius])
            ->orderBy('distance');
    }

    // Get formatted rating as decimal (e.g., "4.7")
    public function getFormattedRating(): string
    {
        return number_format($this->rating, 1);
    }

    // Get star rating as string symbols (★★★★☆)
    public function getStarRating(): string
    {
        $fullStars = round($this->rating);
        $stars = '';

        for ($i = 0; $i < 5; $i++) {
            $stars .= $i < $fullStars ? '★' : '☆';
        }

        return $stars;
    }

    // Get star rating as integer number (1-5)
    public function getStarRatingNumber(): int
    {
        return (int) round($this->rating);
    }

    // Get star rating HTML with emoji stars (⭐⭐⭐⭐☆)
    public function getStarRatingHtml(): string
    {
        $fullStars = floor($this->rating);
        $halfStar = ($this->rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

        $html = '';

        // Full stars
        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '⭐';
        }

        // Half star
        if ($halfStar) {
            $html .= '⭐';
        }

        // Empty stars (optional)
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '☆';
        }

        return $html;
    }

    // Get rating category (Excellent, Very Good, etc.)
    public function getRatingCategory(): string
    {
        if ($this->rating >= 4.5) return 'Excellent';
        if ($this->rating >= 4.0) return 'Very Good';
        if ($this->rating >= 3.5) return 'Good';
        if ($this->rating >= 3.0) return 'Average';
        return 'Below Average';
    }

    // Get rating color class (for Tailwind CSS)
    public function getRatingColorClass(): string
    {
        if ($this->rating >= 4.5) return 'text-green-600';
        if ($this->rating >= 4.0) return 'text-blue-600';
        if ($this->rating >= 3.5) return 'text-yellow-600';
        return 'text-gray-600';
    }

    // Get rating badge class (for Bootstrap)
    public function getRatingBadgeClass(): string
    {
        if ($this->rating >= 4.5) return 'bg-success';
        if ($this->rating >= 4.0) return 'bg-primary';
        if ($this->rating >= 3.5) return 'bg-warning';
        return 'bg-secondary';
    }

    // Common relationship - district
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Common relationship - reviews
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    // Get average rating from reviews
    public function updateRatingFromReviews(): void
    {
        $avgRating = $this->reviews()->avg('rating');
        $reviewsCount = $this->reviews()->count();

        $this->update([
            'rating' => $avgRating ?? 0,
            'reviews_count' => $reviewsCount
        ]);
    }


    // Check if location has coordinates
    public function hasCoordinates(): bool
    {
        return !is_null($this->latitude) && !is_null($this->longitude);
    }

    // Get location name with type
    public function getFullName(): string
    {
        return $this->name . ' (' . ucfirst($this->getLocationType()) . ')';
    }
}
