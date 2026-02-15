<?php
// filepath: d:\Programming\oop\MiniProject\oopMiniProject\app\Models\Restaurant.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Location
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
        'slug',
        'type',
        'description',
        'image_url',
        'images',
        'rating',
        'reviews_count',
        'cuisine_type',
        'price_range',
        'opening_time',
        'closing_time',
        'phone',
        'email',
        'website',
        'address',
        'location',
        'latitude',
        'longitude',
        'facilities',
        'tags',
        'famous_for',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'reviews_count' => 'integer',
        'price_range' => 'integer',
        'images' => 'array',
        'cuisine_type' => 'array',
        'facilities' => 'array',
        'tags' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'is_active' => true,
    ];

    // Implement abstract method from Location
    public function getLocationType(): string
    {
        return 'restaurant';
    }

    // Relationships
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function savedByUsers()
    {
        return $this->morphMany(SavedPlace::class, 'saveable');
    }

    // Check if restaurant is currently open
    public function isOpenNow(): bool
    {
        if (!$this->opening_time || !$this->closing_time) {
            return true; // Assume open if times not set
        }

        $now = Carbon::now()->format('H:i:s');
        $openingTime = Carbon::parse($this->opening_time)->format('H:i:s');
        $closingTime = Carbon::parse($this->closing_time)->format('H:i:s');

        return $now >= $openingTime && $now <= $closingTime;
    }

    // Get price range display
    public function getFormattedPriceRange(): string
    {
        $symbols = [
            1 => '$',      // Budget
            2 => '$$',     // Moderate
            3 => '$$$',    // Upscale
        ];

        return $symbols[$this->price_range] ?? '$$';
    }

    // Get opening hours display
    public function getOpeningHoursDisplay(): string
    {
        if (!$this->opening_time || !$this->closing_time) {
            return 'Hours not available';
        }

        $opening = Carbon::parse($this->opening_time)->format('g:i A');
        $closing = Carbon::parse($this->closing_time)->format('g:i A');

        return "{$opening} - {$closing}";
    }

    // Get all images
    public function getAllImages(): array
    {
        $images = [];

        if ($this->image_url) {
            $images[] = $this->image_url;
        }

        if ($this->images && is_array($this->images)) {
            $images = array_merge($images, $this->images);
        }

        return array_unique($images);
    }

    // Get cuisine types as string
    public function getCuisineTypesString(): string
    {
        if (is_array($this->cuisine_type)) {
            return implode(', ', $this->cuisine_type);
        }
        return $this->cuisine_type ?? 'Not specified';
    }

    // Get formatted rating
    public function getFormattedRating(): string
    {
        return number_format($this->rating ?? 0, 1);
    }

    // Check if has facility
    public function hasFacility($facility): bool
    {
        if (!$this->facilities || !is_array($this->facilities)) {
            return false;
        }
        return in_array($facility, $this->facilities);
    }

    // Get Google Maps URL
    public function getGoogleMapsUrl(): ?string
    {
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps/dir/?api=1&destination={$this->latitude},{$this->longitude}";
        } elseif ($this->address) {
            $address = urlencode($this->address);
            return "https://www.google.com/maps/search/?api=1&query={$address}";
        }

        return null;
    }

    // Get type display name
    public function getTypeDisplayName(): string
    {
        $types = [
            'restaurant' => 'Restaurant',
            'cafe' => 'Café',
            'food_stall' => 'Food Stall',
            'tea_shop' => 'Tea Shop',
        ];

        return $types[$this->type] ?? ucfirst(str_replace('_', ' ', $this->type));
    }

    // Get price range label
    public function getPriceRangeLabel(): string
    {
        $labels = [
            1 => 'Budget (Under ₨500)',
            2 => 'Moderate (₨500-1500)',
            3 => 'Upscale (₨1500-3000)',
        ];

        return $labels[$this->price_range] ?? 'Not specified';
    }

    // Get average cost for display
    public function getAverageCost(): string
    {
        $costs = [
            1 => '₨300 for two',
            2 => '₨800 for two',
            3 => '₨2000 for two',
        ];

        return $costs[$this->price_range] ?? 'Not specified';
    }

    // Get distance from coordinates
    public function getDistanceFrom($latitude, $longitude): float
    {
        if (!$this->latitude || !$this->longitude) {
            return 0;
        }

        // Haversine formula
        $earthRadius = 6371; // km

        $latFrom = deg2rad($latitude);
        $lonFrom = deg2rad($longitude);
        $latTo = deg2rad($this->latitude);
        $lonTo = deg2rad($this->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    // Format distance
    public function getFormattedDistance($latitude, $longitude): string
    {
        $distance = $this->getDistanceFrom($latitude, $longitude);

        if ($distance < 1) {
            return round($distance * 1000) . 'm';
        }

        return number_format($distance, 1) . 'km';
    }
}
