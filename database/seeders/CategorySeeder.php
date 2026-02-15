<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void  // Fixed: Added 'void' return type
    {
        $categories = [
            ['name' => 'Temples & Religious Sites', 'slug' => 'temples-religious', 'icon' => '🛕', 'color' => '#FF6B35'],
            ['name' => 'Historical Sites', 'slug' => 'historical', 'icon' => '🏛️', 'color' => '#F7B801'],
            ['name' => 'Botanical Gardens', 'slug' => 'botanical-gardens', 'icon' => '🌺', 'color' => '#2ECC71'],
            ['name' => 'Mountains & Viewpoints', 'slug' => 'mountains-viewpoints', 'icon' => '⛰️', 'color' => '#5B8FF9'],
            ['name' => 'Waterfalls', 'slug' => 'waterfalls', 'icon' => '💧', 'color' => '#00D9FF'],
            ['name' => 'Wildlife Sanctuaries', 'slug' => 'wildlife', 'icon' => '🐾', 'color' => '#27AE60'],
            ['name' => 'Forests & Nature Reserves', 'slug' => 'forests-nature', 'icon' => '🌲', 'color' => '#8BC34A'],
            ['name' => 'Cultural Experiences', 'slug' => 'cultural', 'icon' => '🎭', 'color' => '#9B59B6'],
            ['name' => 'Beaches', 'slug' => 'beaches', 'icon' => '🏖️', 'color' => '#3498DB'],
            ['name' => 'Museums', 'slug' => 'museums', 'icon' => '🏺', 'color' => '#E74C3C'],
            ['name' => 'Parks & Recreation', 'slug' => 'parks', 'icon' => '🌳', 'color' => '#1ABC9C'],
            ['name' => 'Castles & Palaces', 'slug' => 'castles-palaces', 'icon' => '🏰', 'color' => '#9C27B0'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
