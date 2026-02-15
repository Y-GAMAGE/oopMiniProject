<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'saveable_type',
        'saveable_id',
        'notes',
    ];

    /**
     * Get the user who saved this place
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the saved place (polymorphic)
     */
    public function saveable()
    {
        return $this->morphTo();
    }

    /**
     * Get saved place details
     */
    public function getPlaceDetails()
    {
        $place = $this->saveable;

        if (!$place) {
            return null;
        }

        return [
            'id' => $place->id,
            'name' => $place->name,
            'type' => class_basename($this->saveable_type),
            'image_url' => $place->image_url ?? 'https://via.placeholder.com/400x300',
            'location' => $place->location ?? $place->address ?? 'Location not available',
            'rating' => $place->rating ?? 0,
            'slug' => $place->slug,
            'district' => $place->district->name ?? 'Unknown',
            'country' => $place->district->country->name ?? 'Unknown',
        ];
    }
}
