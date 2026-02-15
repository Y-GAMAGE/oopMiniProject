<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accommodation;
use App\Models\Attraction;
use App\Models\District;
use Illuminate\Support\Str;

class AccommodationSeeder extends Seeder
{
    public function run(): void
    {
        $kandy = District::where('slug', 'kandy')->first();

        if (!$kandy) {
            $this->command->error('Kandy district not found!');
            return;
        }

        // Get Temple of the Sacred Tooth Relic
        $toothRelic = Attraction::where('slug', 'temple-of-tooth-relic')->first();
        if ($toothRelic) {
            $this->createAccommodationsNear($toothRelic, $kandy->id, [
                [
                    'name' => 'The Grand Kandy Hotel',
                    'type' => 'hotel',
                    'description' => 'Luxurious 5-star hotel offering panoramic views of Kandy Lake and the surrounding hills. Features elegant rooms with modern amenities, outdoor pool, and award-winning restaurant.',
                    'price_per_night' => 18500,
                    'total_rooms' => 120,
                    'available_rooms' => 45,
                    'rating' => 4.7,
                    'reviews_count' => 847,
                    'latitude' => 7.2945,
                    'longitude' => 80.6397,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'AC', 'Room Service', 'Swimming Pool', 'Spa', 'Gym'],
                    'tags' => ['Lake View', 'Walking Distance', 'Most Booked', 'Luxury'],
                    'phone' => '+94 81 223 4567',
                    'email' => 'info@grandkandy.lk',
                    'website' => 'https://grandkandy.lk',
                ],
                [
                    'name' => 'Hillside Retreat Guesthouse',
                    'type' => 'guesthouse',
                    'description' => 'Charming family-run guesthouse nestled in the hills with stunning mountain views. Offers comfortable rooms, home-cooked meals, and personalized service in a peaceful setting.',
                    'price_per_night' => 6000,
                    'total_rooms' => 12,
                    'available_rooms' => 5,
                    'rating' => 4.5,
                    'reviews_count' => 234,
                    'latitude' => 7.2978,
                    'longitude' => 80.6342,
                    'facilities' => ['WiFi', 'Parking', 'Fan', 'Hot Water', 'Mountain View', 'Family Friendly'],
                    'tags' => ['Mountain View', 'Family Friendly', 'Verified Property'],
                    'phone' => '+94 77 345 6789',
                    'email' => 'stay@hillsideretreat.lk',
                ],
                [
                    'name' => 'Kandy City Hotel',
                    'type' => 'hotel',
                    'description' => 'Modern hotel located in the heart of Kandy city. Perfect for business and leisure travelers with easy access to major attractions, shopping areas, and restaurants.',
                    'price_per_night' => 9500,
                    'total_rooms' => 65,
                    'available_rooms' => 22,
                    'rating' => 4.2,
                    'reviews_count' => 512,
                    'latitude' => 7.2935,
                    'longitude' => 80.6378,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'AC', 'Room Service', 'Conference Room'],
                    'tags' => ['City Center', 'Free Cancellation'],
                    'phone' => '+94 81 222 3456',
                    'email' => 'reservations@kandycity.lk',
                    'website' => 'https://kandycityhotel.lk',
                ],
                [
                    'name' => 'Lake View Inn',
                    'type' => 'inn',
                    'description' => 'Cozy inn with direct views of Kandy Lake. Ideal for budget travelers seeking comfort and convenience. All rooms feature lake views and basic amenities.',
                    'price_per_night' => 4500,
                    'total_rooms' => 18,
                    'available_rooms' => 8,
                    'rating' => 3.9,
                    'reviews_count' => 156,
                    'latitude' => 7.2940,
                    'longitude' => 80.6410,
                    'facilities' => ['WiFi', 'Fan', 'Hot Water', 'Lake View'],
                    'tags' => ['Lake View', 'Budget Friendly'],
                    'phone' => '+94 81 223 7890',
                ],
                [
                    'name' => 'Royal Heritage Resort',
                    'type' => 'resort',
                    'description' => 'Luxury resort set amidst lush tropical gardens. Offers premium accommodation with private balconies, infinity pool, spa services, and fine dining experiences.',
                    'price_per_night' => 25000,
                    'total_rooms' => 45,
                    'available_rooms' => 12,
                    'rating' => 4.8,
                    'reviews_count' => 623,
                    'latitude' => 7.2912,
                    'longitude' => 80.6425,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'AC', 'Room Service', 'Swimming Pool', 'Spa', 'Gym', 'Bar'],
                    'tags' => ['Luxury', 'Spa', 'Honeymoon Special'],
                    'phone' => '+94 81 224 5678',
                    'email' => 'bookings@royalheritage.lk',
                    'website' => 'https://royalheritage.lk',
                ],
            ]);
        }

        // Royal Botanical Gardens
        $botanicalGardens = Attraction::where('slug', 'royal-botanical-gardens')->first();
        if ($botanicalGardens) {
            $this->createAccommodationsNear($botanicalGardens, $kandy->id, [
                [
                    'name' => 'Peradeniya Garden View Hotel',
                    'type' => 'hotel',
                    'description' => 'Beautiful hotel adjacent to the Royal Botanical Gardens. Perfect for nature lovers with garden views from every room.',
                    'price_per_night' => 12000,
                    'total_rooms' => 40,
                    'available_rooms' => 15,
                    'rating' => 4.4,
                    'reviews_count' => 298,
                    'latitude' => 7.2685,
                    'longitude' => 80.5981,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'AC', 'Garden View'],
                    'tags' => ['Garden View', 'Nature'],
                    'phone' => '+94 81 238 9012',
                ],
                [
                    'name' => 'River Edge Cottage',
                    'type' => 'cottage',
                    'description' => 'Peaceful cottage by the Mahaweli River. Offers authentic Sri Lankan experience with traditional architecture and modern comforts.',
                    'price_per_night' => 7500,
                    'total_rooms' => 8,
                    'available_rooms' => 3,
                    'rating' => 4.6,
                    'reviews_count' => 142,
                    'latitude' => 7.2701,
                    'longitude' => 80.5945,
                    'facilities' => ['WiFi', 'Parking', 'Fan', 'River View', 'BBQ Area'],
                    'tags' => ['River View', 'Pet Friendly', 'Unique Stay'],
                    'phone' => '+94 77 456 7890',
                ],
            ]);
        }

        // Kandy Lake
        $kandyLake = Attraction::where('slug', 'kandy-lake')->first();
        if ($kandyLake) {
            $this->createAccommodationsNear($kandyLake, $kandy->id, [
                [
                    'name' => 'Lakeside Luxury Apartments',
                    'type' => 'hotel',
                    'description' => 'Modern serviced apartments with panoramic lake views. Fully equipped kitchens and living areas perfect for extended stays.',
                    'price_per_night' => 11000,
                    'total_rooms' => 24,
                    'available_rooms' => 9,
                    'rating' => 4.5,
                    'reviews_count' => 387,
                    'latitude' => 7.2932,
                    'longitude' => 80.6405,
                    'facilities' => ['WiFi', 'Parking', 'AC', 'Kitchen', 'Lake View', 'Washing Machine'],
                    'tags' => ['Lake View', 'Apartment', 'Long Stay'],
                    'phone' => '+94 81 222 8901',
                ],
            ]);
        }

        // Pinnawala Elephant Orphanage
        $pinnawala = Attraction::where('slug', 'pinnawala-elephant-orphanage')->first();
        if ($pinnawala) {
            $this->createAccommodationsNear($pinnawala, $kandy->id, [
                [
                    'name' => 'Elephant View Hotel',
                    'type' => 'hotel',
                    'description' => 'Unique hotel overlooking the elephant bathing area. Watch elephants from your room balcony while enjoying comfortable accommodation.',
                    'price_per_night' => 14000,
                    'total_rooms' => 32,
                    'available_rooms' => 11,
                    'rating' => 4.6,
                    'reviews_count' => 421,
                    'latitude' => 7.2997,
                    'longitude' => 80.3857,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'AC', 'River View', 'Balcony'],
                    'tags' => ['Elephant View', 'Unique Experience', 'Wildlife'],
                    'phone' => '+94 35 226 7890',
                ],
                [
                    'name' => 'Pinnawala Homestay',
                    'type' => 'homestay',
                    'description' => 'Authentic homestay experience with local family. Enjoy home-cooked Sri Lankan meals and personalized tours.',
                    'price_per_night' => 3500,
                    'total_rooms' => 5,
                    'available_rooms' => 2,
                    'rating' => 4.7,
                    'reviews_count' => 89,
                    'latitude' => 7.3012,
                    'longitude' => 80.3892,
                    'facilities' => ['WiFi', 'Fan', 'Home-cooked Meals', 'Cultural Experience'],
                    'tags' => ['Homestay', 'Authentic', 'Budget'],
                    'phone' => '+94 77 567 8901',
                ],
            ]);
        }

        // Bahiravokanda Vihara
        $bahiravokanda = Attraction::where('slug', 'bahiravokanda-vihara')->first();
        if ($bahiravokanda) {
            $this->createAccommodationsNear($bahiravokanda, $kandy->id, [
                [
                    'name' => 'Hilltop Kandy Resort',
                    'type' => 'resort',
                    'description' => 'Stunning hilltop resort with 360-degree views of Kandy city. Luxury rooms, infinity pool, and world-class amenities.',
                    'price_per_night' => 22000,
                    'total_rooms' => 38,
                    'available_rooms' => 14,
                    'rating' => 4.8,
                    'reviews_count' => 534,
                    'latitude' => 7.3012,
                    'longitude' => 80.6389,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'AC', 'Swimming Pool', 'Spa', 'City View', 'Bar'],
                    'tags' => ['Hilltop', 'Luxury', 'City View'],
                    'phone' => '+94 81 223 9012',
                ],
            ]);
        }

        // Udawattakele Forest
        $udawattakele = Attraction::where('slug', 'udawattakele-forest')->first();
        if ($udawattakele) {
            $this->createAccommodationsNear($udawattakele, $kandy->id, [
                [
                    'name' => 'Forest Edge Eco Lodge',
                    'type' => 'resort',
                    'description' => 'Eco-friendly lodge at the edge of Udawattakele Forest. Sustainable accommodation with nature trails and bird watching.',
                    'price_per_night' => 8500,
                    'total_rooms' => 16,
                    'available_rooms' => 6,
                    'rating' => 4.4,
                    'reviews_count' => 176,
                    'latitude' => 7.2987,
                    'longitude' => 80.6456,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'Nature Trails', 'Eco-Friendly'],
                    'tags' => ['Eco-Friendly', 'Nature', 'Bird Watching'],
                    'phone' => '+94 81 224 8901',
                ],
            ]);
        }

        // Knuckles Mountain Range
        $knuckles = Attraction::where('slug', 'knuckles-mountain-range')->first();
        if ($knuckles) {
            $this->createAccommodationsNear($knuckles, $kandy->id, [
                [
                    'name' => 'Knuckles Mountain View Resort',
                    'type' => 'resort',
                    'description' => 'Adventure resort perfect for trekkers and nature enthusiasts. Guided tours, camping facilities, and mountain views.',
                    'price_per_night' => 9800,
                    'total_rooms' => 20,
                    'available_rooms' => 8,
                    'rating' => 4.3,
                    'reviews_count' => 267,
                    'latitude' => 7.4534,
                    'longitude' => 80.7891,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'Trekking', 'Mountain View', 'Camp Site'],
                    'tags' => ['Adventure', 'Trekking', 'Mountain View'],
                    'phone' => '+94 77 678 9012',
                ],
            ]);
        }

        // Ambuluwawa Tower
        $ambuluwawa = Attraction::where('slug', 'ambuluwawa-tower')->first();
        if ($ambuluwawa) {
            $this->createAccommodationsNear($ambuluwawa, $kandy->id, [
                [
                    'name' => 'Gampola Heights Hotel',
                    'type' => 'hotel',
                    'description' => 'Modern hotel in Gampola with easy access to Ambuluwawa Tower. Comfortable rooms and local cuisine.',
                    'price_per_night' => 7000,
                    'total_rooms' => 28,
                    'available_rooms' => 12,
                    'rating' => 4.1,
                    'reviews_count' => 193,
                    'latitude' => 7.1645,
                    'longitude' => 80.5734,
                    'facilities' => ['WiFi', 'Parking', 'Restaurant', 'AC'],
                    'tags' => ['Convenient', 'Local Experience'],
                    'phone' => '+94 81 235 6789',
                ],
            ]);
        }

        $this->command->info('Accommodations seeded successfully!');
    }

    private function createAccommodationsNear($attraction, $districtId, $accommodations)
    {
        foreach ($accommodations as $data) {
            Accommodation::create([
                'district_id' => $districtId,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'],
                'image_url' => '/images/accommodations/' . Str::slug($data['name']) . '.jpg',
                'type' => $data['type'],
                'price_per_night' => $data['price_per_night'],
                'total_rooms' => $data['total_rooms'],
                'available_rooms' => $data['available_rooms'],
                'rating' => $data['rating'],
                'reviews_count' => $data['reviews_count'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'facilities' => $data['facilities'],
                'tags' => $data['tags'],
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'] ?? null,
                'website' => $data['website'] ?? null,
                'address' => $data['description'], // Use description as address for now
                'is_active' => true,
            ]);
        }
    }
}
