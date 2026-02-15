<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profile_picture',
        'country',
        'status',
        'role',
        'google_id',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Get saved places
     */
    public function savedPlaces()
    {
        return $this->hasMany(SavedPlace::class);
    }

    /**
     * Check if user has saved a specific place
     */

       public function hasSaved($saveableType, $saveableId)
    {
        return $this->savedPlaces()
            ->where('saveable_type', $saveableType)
            ->where('saveable_id', $saveableId)
            ->exists();
    }

    /**
     * Save a place
     */
    public function savePlace($saveableType, $saveableId, $notes = null)
    {
        return $this->savedPlaces()->create([
            'saveable_type' => $saveableType,
            'saveable_id' => $saveableId,
            'notes' => $notes,
        ]);
    }

    /**
     * Unsave a place
     */
    public function unsavePlace($saveableType, $saveableId)
    {
        return $this->savedPlaces()
            ->where('saveable_type', $saveableType)
            ->where('saveable_id', $saveableId)
            ->delete();
    }
}
