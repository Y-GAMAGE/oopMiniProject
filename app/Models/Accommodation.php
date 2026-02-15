<?php

namespace App\Models;

class Accommodation extends Location
{
    protected $fillable = [
        'district_id',
        'name',
        'slug',
        'description',
        'image_url',
        'images',
        'rating',
        'reviews_count',
        'type',
        'price_per_night',
        'total_rooms',
        'available_rooms',
        'phone',
        'email',
        'website',
        'address',
        'location',
        'latitude',
        'longitude',
        'facilities',
        'tags',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'reviews_count' => 'integer',
        'price_per_night' => 'decimal:2',
        'total_rooms' => 'integer',
        'available_rooms' => 'integer',
        'images' => 'array',
        'facilities' => 'array',
        'tags' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_active' => 'boolean',
    ];

    // Implement abstract method
    public function getLocationType(): string
    {
        return 'accommodation';
    }

    // Get formatted price
    public function getFormattedPrice(): string
    {
        return 'From Rs. ' . number_format($this->price_per_night, 0) . '/night';
    }

    // Check if rooms available
    public function hasAvailability(): bool
    {
        return $this->available_rooms > 0;
    }

    // Find nearby accommodations
    public function nearbyAccommodations($limit = 4)
    {
        if (!$this->hasCoordinates()) {
            return collect([]);
        }

        return static::where('id', '!=', $this->id)
            ->nearby($this->latitude, $this->longitude, 5)
            ->where('is_active', true)
            ->limit($limit)
            ->get();
    }

    // Scope for property type
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope for price range
    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price_per_night', [$min, $max]);
    }

    // Scope for star rating
    public function scopeStarRating($query, $stars)
    {
        $min = $stars - 0.5;
        $max = $stars + 0.4;
        return $query->whereBetween('rating', [$min, $max]);
    }

    // Scope for facilities
    public function scopeHasFacility($query, $facility)
    {
        return $query->whereJsonContains('facilities', $facility);
    }

    // Scope for available accommodations
    public function scopeAvailable($query)
    {
        return $query->where('available_rooms', '>', 0);
    }

    // Get availability status
    public function getAvailabilityStatus(): array
    {
        return [
            'available' => $this->hasAvailability(),
            'rooms_available' => $this->available_rooms,
            'message' => $this->hasAvailability() ? 'Rooms available' : 'Fully booked'
        ];
    }
}
