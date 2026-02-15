<?php
// filepath: app/Models/District.php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name',
        'slug',
        'region',
        'description',
        'image_url',
        'attractions_count',
        'best_season',
        'total_categories'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($district) {
            if (empty($district->slug)) {
                $district->slug = Str::slug($district->name);
            }
        });
    }

    // Belongs to country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Has many attractions
    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, Attraction::class, 'district_id', 'id', 'id', 'category_id')
            ->distinct();
    }


    // Search scope
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
        }
        return $query;
    }

    // Sort scope
    public function scopeSortBy($query, $sortBy)
    {
        switch ($sortBy) {
            case 'most_attractions':
                return $query->orderByDesc('attractions_count');
            case 'newest':
                return $query->latest();
            default: // alphabetical
                return $query->orderBy('name');
        }
    }

    public function getTransportOptions()
    {
        // This will be populated from a config or database
        return config("transport.{$this->country->slug}.{$this->slug}", []);
    }
}
