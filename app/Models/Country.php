<?php
// filepath: app/Models/Country.php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'tagline',
        'continent',
        'districts_count',
         'popular_categories',
         'languages',
        'currency',
        'image_url'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($country) {
            if (empty($country->slug)) {
                $country->slug = Str::slug($country->name);
            }
        });
    }

    // District relationship
    public function districts()
    {
        return $this->hasMany(District::class);
    }

     // Get attractions through districts
    public function attractions()
    {
        return $this->hasManyThrough(
            \App\Models\Attraction::class,
            District::class,
            'country_id',    // Foreign key on districts table
            'district_id',   // Foreign key on attractions table
            'id',            // Local key on countries table
            'id'             // Local key on districts table
        );
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

    // Continent filter
    public function scopeContinent($query, $continent)
    {
        if ($continent) {
            return $query->where('continent', $continent);
        }
        return $query;
    }
}
