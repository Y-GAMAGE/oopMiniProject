<?php

namespace App\Models;

use Carbon\Carbon;

class Attraction extends Location
{
    protected $fillable = [
        'district_id',
        'category_id',
        'name',
        'slug',
        'description',
        'image_url',
        'images',
        'is_featured',
        'rating',
        'reviews_count',
        'entry_fee',
        'facilities',
        'opening_time',
        'closing_time',
        'is_open_now',
        'location',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'best_time_to_visit',
        'duration',
        'languages',
        'tags',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_open_now' => 'boolean',
        'rating' => 'decimal:1',
        'reviews_count' => 'integer',
        'entry_fee' => 'decimal:2',
        'facilities' => 'array',
        'images' => 'array',
        'tags' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Implement abstract method
    public function getLocationType(): string
    {
        return 'attraction';
    }

    // Relationships
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Check if attraction is currently open
    public function isOpenNow(): bool
    {
        if (!$this->opening_time || !$this->closing_time) {
            return $this->is_open_now;
        }

        $now = Carbon::now()->format('H:i:s');
        $openingTime = Carbon::parse($this->opening_time)->format('H:i:s');
        $closingTime = Carbon::parse($this->closing_time)->format('H:i:s');

        return $now >= $openingTime && $now <= $closingTime;
    }

    // Get opening hours formatted
    public function getOpeningHours(): array
    {
        return [
            'opening' => $this->opening_time ? Carbon::parse($this->opening_time)->format('g:i A') : 'N/A',
            'closing' => $this->closing_time ? Carbon::parse($this->closing_time)->format('g:i A') : 'N/A',
            'is_open' => $this->isOpenNow(),
        ];
    }

    // Get formatted entry fee
    public function getFormattedEntryFee(): string
    {
        if ($this->entry_fee === null || $this->entry_fee == 0) {
            return 'Free';
        }
        return 'Rs. ' . number_format($this->entry_fee, 0);
    }

    // Get all images (main image + additional images)
    public function getAllImages(): array
    {
        $allImages = [];

        // Add main image first
        if ($this->image_url) {
            $allImages[] = $this->image_url;
        }

        // Add additional images if they exist
        if ($this->images && is_array($this->images)) {
            $allImages = array_merge($allImages, $this->images);
        }

        return $allImages;
    }

    // Get facility icons
    public function getFacilityIcons(): array
    {
        $icons = [
            'parking' => ['icon' => '🅿️', 'name' => 'Parking'],
            'wifi' => ['icon' => '📶', 'name' => 'WiFi'],
            'restaurant' => ['icon' => '🍽️', 'name' => 'Restaurant'],
            'guide' => ['icon' => '👤', 'name' => 'Tour Guide'],
            'wheelchair' => ['icon' => '♿', 'name' => 'Wheelchair Access'],
            'restroom' => ['icon' => '🚻', 'name' => 'Restrooms'],
        ];

        return collect($this->facilities ?? [])
            ->map(fn($facility) => $icons[$facility] ?? ['icon' => '📌', 'name' => ucfirst($facility)])
            ->toArray();
    }

    // Find nearby attractions
    public function nearbyAttractions($limit = 4)
    {
        if (!$this->latitude || !$this->longitude) {
            return collect([]);
        }

        return static::where('id', '!=', $this->id)
            ->where('district_id', $this->district_id)
            ->nearby($this->latitude, $this->longitude, 20)
            ->limit($limit)
            ->get();
    }

    // Find nearby restaurants
    public function nearbyRestaurants($limit = 3)
    {
        if (!$this->latitude || !$this->longitude) {
            return collect([]);
        }

        return Restaurant::nearby($this->latitude, $this->longitude, 5)
            ->limit($limit)
            ->get();
    }

    // Find nearby accommodations
    public function nearbyAccommodations($limit = 3)
    {
        if (!$this->latitude || !$this->longitude) {
            return collect([]);
        }

        return Accommodation::nearby($this->latitude, $this->longitude, 5)
            ->limit($limit)
            ->get();
    }

    // Scopes
    public function scopeByRating($query, $minRating)
    {
        return $query->where('rating', '>=', $minRating);
    }

    public function scopeByEntryFee($query, $maxFee)
    {
        return $query->where('entry_fee', '<=', $maxFee)
                     ->orWhereNull('entry_fee');
    }

    public function scopeWithFacilities($query, $facilities)
    {
        foreach ($facilities as $facility) {
            $query->whereJsonContains('facilities', $facility);
        }
        return $query;
    }

    public function scopeOpenNow($query)
    {
        $now = Carbon::now()->format('H:i:s');

        return $query->where('is_open_now', true)
                    ->where(function($q) use ($now) {
                        $q->whereNull('opening_time')
                          ->orWhere(function($q2) use ($now) {
                              $q2->whereTime('opening_time', '<=', $now)
                                 ->whereTime('closing_time', '>=', $now);
                          });
                    });
    }

    public function getTagsArray(): array
    {
        if (is_array($this->tags)) {
            return $this->tags;
        }

        if (is_string($this->tags)) {
            $decoded = json_decode($this->tags, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

}
