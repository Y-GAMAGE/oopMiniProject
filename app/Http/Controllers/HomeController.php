<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get 8 featured countries with sample images
        $featuredCountries = $this->getFeaturedCountries();

        // Get 8 categories with icons
        $categories = $this->getCategories();

        return view('home', compact('featuredCountries', 'categories'));
    }

    private function getFeaturedCountries()
    {
        // Sample data with actual images - replace with database query later
        $sampleCountries = [
            [
                'name' => 'Greece',
                'slug' => 'greece',
                'attractions_count' => 250,
                'image_url' => 'https://images.unsplash.com/photo-1613395877344-13d4a8e0d49e?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Japan',
                'slug' => 'japan',
                'attractions_count' => 380,
                'image_url' => 'https://images.unsplash.com/photo-1542640244-7e672d6cef4e?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'France',
                'slug' => 'france',
                'attractions_count' => 420,
                'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Maldives',
                'slug' => 'maldives',
                'attractions_count' => 150,
                'image_url' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Italy',
                'slug' => 'italy',
                'attractions_count' => 500,
                'image_url' => 'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'UAE',
                'slug' => 'uae',
                'attractions_count' => 200,
                'image_url' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Switzerland',
                'slug' => 'switzerland',
                'attractions_count' => 280,
                'image_url' => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?w=600&h=400&fit=crop'
            ],
            [
                'name' => 'Peru',
                'slug' => 'peru',
                'attractions_count' => 180,
                'image_url' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?w=600&h=400&fit=crop'
            ],
        ];

        // Try to get from database, fallback to sample data
        try {
            $countries = Country::withCount('attractions')
                ->orderBy('attractions_count', 'desc')
                ->limit(8)
                ->get();

            if ($countries->count() >= 8) {
                return $countries;
            }
        } catch (\Exception $e) {
            // Database not ready, use sample data
        }

        return collect($sampleCountries)->map(function ($country) {
            return (object) $country;
        });
    }

    private function getCategories()
    {
        // Sample categories with emojis
        $sampleCategories = [
            [
                'name' => 'Temples',
                'slug' => 'temples',
                'attractions_count' => 320,
                'icon' => '🛕'
            ],
            [
                'name' => 'Beaches',
                'slug' => 'beaches',
                'attractions_count' => 450,
                'icon' => '🏖️'
            ],
            [
                'name' => 'Historical Sites',
                'slug' => 'historical-sites',
                'attractions_count' => 380,
                'icon' => '🏛️'
            ],
            [
                'name' => 'Forests',
                'slug' => 'forests',
                'attractions_count' => 250,
                'icon' => '🌲'
            ],
            [
                'name' => 'Botanical Gardens',
                'slug' => 'botanical-gardens',
                'attractions_count' => 180,
                'icon' => '🌿'
            ],
            [
                'name' => 'Mountains',
                'slug' => 'mountains',
                'attractions_count' => 290,
                'icon' => '⛰️'
            ],
            [
                'name' => 'Wildlife',
                'slug' => 'wildlife',
                'attractions_count' => 240,
                'icon' => '🦁'
            ],
            [
                'name' => 'Cultural Sites',
                'slug' => 'cultural-sites',
                'attractions_count' => 340,
                'icon' => '🎭'
            ],
        ];

        // Try to get from database, fallback to sample data
        try {
            $categories = Category::withCount('attractions')
                ->orderBy('name')
                ->limit(8)
                ->get();

            if ($categories->count() >= 8) {
                return $categories;
            }
        } catch (\Exception $e) {
            // Database not ready, use sample data
        }

        return collect($sampleCategories)->map(function ($category) {
            return (object) $category;
        });
    }

    public function submitContactForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // TODO: Send email or store in database
        // Mail::to('contact@travelease.com')->send(new ContactMessage($validated));

        return back()->with('success', 'Thank you for contacting us. We will respond soon!');
    }
}
