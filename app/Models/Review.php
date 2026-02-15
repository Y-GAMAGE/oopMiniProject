<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewable_id',
        'reviewable_type',
        'user_name',
        'user_avatar',
        'rating',
        'title',
        'comment',
        'helpful_count',
        'visit_date',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'helpful_count' => 'integer',
        'visit_date' => 'date',
    ];

    // Polymorphic relationship
    public function reviewable()
    {
        return $this->morphTo();
    }

    // Get time ago
    public function getTimeAgo(): string
    {
        return $this->created_at->diffForHumans();
    }

    // Get star rating HTML
    public function getStarRating(): string
    {
        $fullStars = floor($this->rating);
        $halfStar = ($this->rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

        return str_repeat('⭐', $fullStars) .
               ($halfStar ? '½' : '') .
               str_repeat('☆', $emptyStars);
    }
}
