<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attraction;
use App\Models\District;
use App\Models\Category;

class AttractionSeeder extends Seeder
{
    public function run(): void
    {
        // Get categories
        $templesCategory = Category::where('slug', 'temples-religious')->first();
        $historicalCategory = Category::where('slug', 'historical')->first();
        $botanicalCategory = Category::where('slug', 'botanical-gardens')->first();
        $mountainsCategory = Category::where('slug', 'mountains-viewpoints')->first();
        $waterfallsCategory = Category::where('slug', 'waterfalls')->first();
        $wildlifeCategory = Category::where('slug', 'wildlife')->first();
        $forestsCategory = Category::where('slug', 'forests-nature')->first();
        $culturalCategory = Category::where('slug', 'cultural')->first();

        // Get Kandy district
        $kandy = District::where('slug', 'kandy')->first();

        if ($kandy) {
            // TEMPLES & RELIGIOUS SITES
            if ($templesCategory) {
                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $templesCategory->id,
                    'name' => 'Temple of the Sacred Tooth Relic',
                    'slug' => 'temple-of-tooth-relic',
                    'description' => 'Sacred Buddhist temple housing the relic of Buddha\'s tooth, a UNESCO World Heritage Site and one of the most important pilgrimage sites for Buddhists worldwide.',
                    'image_url' => 'images/attractions/totr/totr2.jpeg',
                    'rating' => 4.8,
                    'reviews_count' => 2341,
                    'entry_fee' => 1500,
                    'facilities' => ['guide', 'restroom', 'wheelchair'],
                    'opening_time' => '05:30:00',
                    'closing_time' => '20:00:00',
                    'is_open_now' => true,
                    'location' => 'Sri Dalada Veediya, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $templesCategory->id,
                    'name' => 'Bahiravokanda Vihara Buddha Statue',
                    'slug' => 'bahiravokanda-vihara',
                    'description' => 'Giant white Buddha statue overlooking Kandy city, offering panoramic views of the entire valley and surrounding mountains.',
                    'image_url' => 'images/attractions/Bahirawakanda.jpeg',
                    'rating' => 4.6,
                    'reviews_count' => 856,
                    'entry_fee' => null,
                    'facilities' => ['parking', 'restroom'],
                    'opening_time' => '06:00:00',
                    'closing_time' => '18:00:00',
                    'is_open_now' => true,
                    'location' => 'Bahiravokanda, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $templesCategory->id,
                    'name' => 'Gadaladeniya Temple',
                    'slug' => 'gadaladeniya-temple',
                    'description' => 'Ancient Buddhist temple built in 1344 AD, featuring unique architectural style combining South Indian and Sinhalese elements.',
                    'image_url' => 'images/attractions/Gadaladeniya.jpeg',
                    'rating' => 4.5,
                    'reviews_count' => 432,
                    'entry_fee' => 300,
                    'facilities' => ['parking', 'guide'],
                    'opening_time' => '07:00:00',
                    'closing_time' => '17:00:00',
                    'is_open_now' => true,
                    'location' => 'Pilimathalawa, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $templesCategory->id,
                    'name' => 'Embekke Devalaya',
                    'slug' => 'embekke-devalaya',
                    'description' => 'Famous for its intricate wood carvings dating back to the 14th century, considered one of the finest examples of Sinhalese craftsmanship.',
                    'image_url' => 'images/attractions/Embekke.jpeg',
                    'rating' => 4.7,
                    'reviews_count' => 523,
                    'entry_fee' => 500,
                    'facilities' => ['parking', 'guide', 'restroom'],
                    'opening_time' => '07:00:00',
                    'closing_time' => '18:00:00',
                    'is_open_now' => true,
                    'location' => 'Udunuwara, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $templesCategory->id,
                    'name' => 'Lankatilaka Temple',
                    'slug' => 'lankatilaka-temple',
                    'description' => 'Historic Buddhist temple built on a rock, showcasing magnificent murals and a massive Buddha statue carved into the rock.',
                    'image_url' => 'images/attractions/Lankatilaka.jpeg',
                    'rating' => 4.6,
                    'reviews_count' => 398,
                    'entry_fee' => 300,
                    'facilities' => ['parking'],
                    'opening_time' => '07:00:00',
                    'closing_time' => '17:30:00',
                    'is_open_now' => true,
                    'location' => 'Hiripitiya, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $templesCategory->id,
                    'name' => 'Degaldoruwa Raja Maha Viharaya',
                    'slug' => 'degaldoruwa-temple',
                    'description' => 'Rock temple famous for its 18th-century frescoes depicting Buddhist stories and Kandyan era paintings.',
                    'image_url' => 'images/attractions/Degaldoruwa.jpeg',
                    'rating' => 4.4,
                    'reviews_count' => 267,
                    'entry_fee' => null,
                    'facilities' => ['parking', 'guide'],
                    'opening_time' => '08:00:00',
                    'closing_time' => '17:00:00',
                    'is_open_now' => true,
                    'location' => 'Degaldoruwa, Kundasale',
                ]);
            }

            // BOTANICAL GARDENS
            if ($botanicalCategory) {
                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $botanicalCategory->id,
                    'name' => 'Royal Botanical Gardens Peradeniya',
                    'slug' => 'royal-botanical-gardens',
                    'description' => '147-acre botanical garden featuring over 4,000 species of plants, including orchids, spices, medicinal plants, and giant bamboo.',
                    'image_url' => 'images/attractions/RoyalBotanicalGardens.jpeg',
                    'rating' => 4.7,
                    'reviews_count' => 1892,
                    'entry_fee' => 1500,
                    'facilities' => ['parking', 'restaurant', 'restroom', 'wheelchair', 'guide'],
                    'opening_time' => '07:30:00',
                    'closing_time' => '17:30:00',
                    'is_open_now' => true,
                    'location' => 'Peradeniya, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $botanicalCategory->id,
                    'name' => 'Udawattakele Forest Reserve',
                    'slug' => 'udawattakele-forest',
                    'description' => 'Historic forest sanctuary in the heart of Kandy city, offering nature walks and bird watching opportunities.',
                    'image_url' => 'images/attractions/Udawatte.jpeg',
                    'rating' => 4.3,
                    'reviews_count' => 645,
                    'entry_fee' => 200,
                    'facilities' => ['parking', 'guide', 'restroom'],
                    'opening_time' => '06:00:00',
                    'closing_time' => '18:00:00',
                    'is_open_now' => true,
                    'location' => 'Kandy City Center',
                ]);
            }

            // MOUNTAINS & VIEWPOINTS
            if ($mountainsCategory) {
                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $mountainsCategory->id,
                    'name' => 'Kandy Lake',
                    'slug' => 'kandy-lake',
                    'description' => 'Artificial lake built in 1807 in the heart of Kandy city, surrounded by scenic walking paths and the Temple of the Tooth.',
                    'image_url' => 'images/attractions/KandyLake.jpeg',
                    'rating' => 4.5,
                    'reviews_count' => 1567,
                    'entry_fee' => null,
                    'facilities' => ['parking', 'restroom'],
                    'opening_time' => '00:00:00',
                    'closing_time' => '23:59:59',
                    'is_open_now' => true,
                    'location' => 'Kandy City Center',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $mountainsCategory->id,
                    'name' => 'Arthur\'s Seat Viewpoint',
                    'slug' => 'arthurs-seat-viewpoint',
                    'description' => 'Stunning viewpoint offering panoramic views of the Knuckles Mountain Range and surrounding tea estates.',
                    'image_url' => 'images/attractions/View point.jpeg',
                    'rating' => 4.6,
                    'reviews_count' => 734,
                    'entry_fee' => null,
                    'facilities' => ['parking'],
                    'opening_time' => '06:00:00',
                    'closing_time' => '18:00:00',
                    'is_open_now' => true,
                    'location' => 'Dolosbage, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $mountainsCategory->id,
                    'name' => 'Hanthana Mountain Range',
                    'slug' => 'hanthana-mountain',
                    'description' => 'Popular hiking destination with multiple trails offering spectacular views of Kandy and surrounding areas.',
                    'image_url' => 'images/attractions/Hanthana.jpeg',
                    'rating' => 4.7,
                    'reviews_count' => 892,
                    'entry_fee' => null,
                    'facilities' => ['guide'],
                    'opening_time' => '05:00:00',
                    'closing_time' => '17:00:00',
                    'is_open_now' => true,
                    'location' => 'Hanthana, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $mountainsCategory->id,
                    'name' => 'Ambuluwawa Tower',
                    'slug' => 'ambuluwawa-tower',
                    'description' => 'Unique multi-religious complex with a spiral tower offering 360-degree views of surrounding mountains and valleys.',
                    'image_url' => 'images/attractions/Ambuluwawa.jpeg',
                    'rating' => 4.8,
                    'reviews_count' => 1234,
                    'entry_fee' => 100,
                    'facilities' => ['parking', 'restroom'],
                    'opening_time' => '06:00:00',
                    'closing_time' => '18:00:00',
                    'is_open_now' => true,
                    'location' => 'Gampola, Kandy',
                ]);
            }

            // WATERFALLS
            if ($waterfallsCategory) {
                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $waterfallsCategory->id,
                    'name' => 'Ramboda Falls',
                    'slug' => 'ramboda-falls',
                    'description' => '109-meter high waterfall cascading down in multiple tiers, visible from the main Kandy-Nuwara Eliya highway.',
                    'image_url' => 'images/attractions/Ramboda.jpeg',
                    'rating' => 4.5,
                    'reviews_count' => 987,
                    'entry_fee' => null,
                    'facilities' => ['parking', 'restaurant'],
                    'opening_time' => '00:00:00',
                    'closing_time' => '23:59:59',
                    'is_open_now' => true,
                    'location' => 'Ramboda, Kandy-Nuwara Eliya Road',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $waterfallsCategory->id,
                    'name' => 'Hunas Falls',
                    'slug' => 'hunas-falls',
                    'description' => 'Secluded waterfall surrounded by lush forest, offering a natural pool for swimming and peaceful atmosphere.',
                    'image_url' => 'images/attractions/Hunas.jpeg',
                    'rating' => 4.4,
                    'reviews_count' => 456,
                    'entry_fee' => null,
                    'facilities' => ['parking'],
                    'opening_time' => '06:00:00',
                    'closing_time' => '18:00:00',
                    'is_open_now' => true,
                    'location' => 'Elkaduwa, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $waterfallsCategory->id,
                    'name' => 'Laxapana Falls',
                    'slug' => 'laxapana-falls',
                    'description' => 'One of the widest waterfalls in Sri Lanka, dropping 129 meters with a spectacular curtain of water.',
                    'image_url' => 'images/attractions/Laxapana.jpeg',
                    'rating' => 4.6,
                    'reviews_count' => 723,
                    'entry_fee' => null,
                    'facilities' => ['parking'],
                    'opening_time' => '00:00:00',
                    'closing_time' => '23:59:59',
                    'is_open_now' => true,
                    'location' => 'Maskeliya, Near Kandy',
                ]);
            }

            // WILDLIFE & NATURE
            if ($wildlifeCategory) {
                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $wildlifeCategory->id,
                    'name' => 'Pinnawala Elephant Orphanage',
                    'slug' => 'pinnawala-elephant-orphanage',
                    'description' => 'World-famous elephant orphanage and breeding ground, home to over 80 elephants including babies, with daily bathing sessions in the river.',
                    'image_url' => 'images/attractions/Pinnawala.jpeg',
                    'rating' => 4.5,
                    'reviews_count' => 2345,
                    'entry_fee' => 2500,
                    'facilities' => ['parking', 'restaurant', 'restroom', 'guide'],
                    'opening_time' => '08:30:00',
                    'closing_time' => '17:30:00',
                    'is_open_now' => true,
                    'location' => 'Pinnawala, Rambukkana',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $wildlifeCategory->id,
                    'name' => 'Millennium Elephant Foundation',
                    'slug' => 'millennium-elephant-foundation',
                    'description' => 'Ethical elephant sanctuary focused on conservation and welfare, offering interactive experiences with rescued elephants.',
                    'image_url' => 'images/attractions/Elephant foundation.jpeg',
                    'rating' => 4.7,
                    'reviews_count' => 1123,
                    'entry_fee' => 2000,
                    'facilities' => ['parking', 'restroom', 'guide'],
                    'opening_time' => '08:00:00',
                    'closing_time' => '17:00:00',
                    'is_open_now' => true,
                    'location' => 'Kegalle, Near Kandy',
                ]);
            }

            // FORESTS & NATURE RESERVES
            if ($forestsCategory) {
                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $forestsCategory->id,
                    'name' => 'Knuckles Mountain Range',
                    'slug' => 'knuckles-mountain-range',
                    'description' => 'UNESCO World Heritage Site offering trekking trails, diverse ecosystems, misty mountains, and pristine waterfalls.',
                    'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                    'rating' => 4.9,
                    'reviews_count' => 1567,
                    'entry_fee' => 500,
                    'facilities' => ['guide'],
                    'opening_time' => '05:00:00',
                    'closing_time' => '18:00:00',
                    'is_open_now' => true,
                    'location' => 'Matale-Kandy Border',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $forestsCategory->id,
                    'name' => 'Victoria Randenigala Rantambe Sanctuary',
                    'slug' => 'victoria-sanctuary',
                    'description' => 'Wildlife sanctuary surrounding three reservoirs, home to elephants, leopards, and diverse bird species.',
                    'image_url' => 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800',
                    'rating' => 4.3,
                    'reviews_count' => 456,
                    'entry_fee' => 1000,
                    'facilities' => ['guide'],
                    'opening_time' => '06:00:00',
                    'closing_time' => '17:00:00',
                    'is_open_now' => true,
                    'location' => 'Teldeniya, Kandy',
                ]);
            }

            // CULTURAL EXPERIENCES
            if ($culturalCategory) {
                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $culturalCategory->id,
                    'name' => 'Kandy Cultural Dance Show',
                    'slug' => 'kandy-cultural-dance',
                    'description' => 'Traditional Kandyan dance performance showcasing authentic Sri Lankan culture, music, and fire walking finale.',
                    'image_url' => 'images/attractions/Cultural-dance-show.jpeg',
                    'rating' => 4.6,
                    'reviews_count' => 923,
                    'entry_fee' => 1000,
                    'facilities' => ['parking', 'restroom'],
                    'opening_time' => '17:00:00',
                    'closing_time' => '19:00:00',
                    'is_open_now' => false,
                    'location' => 'Kandy Cultural Center, Kandy Lake',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $culturalCategory->id,
                    'name' => 'Ceylon Tea Museum',
                    'slug' => 'ceylon-tea-museum',
                    'description' => 'Museum showcasing the history of Ceylon tea industry, housed in a renovated tea factory with tea tasting sessions.',
                    'image_url' => 'images/attractions/Ceylon-tea-museum.jpeg',
                    'rating' => 4.5,
                    'reviews_count' => 678,
                    'entry_fee' => 500,
                    'facilities' => ['parking', 'restaurant', 'restroom', 'guide'],
                    'opening_time' => '08:30:00',
                    'closing_time' => '16:00:00',
                    'is_open_now' => true,
                    'location' => 'Hantane, Kandy',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $culturalCategory->id,
                    'name' => 'Kandy National Museum',
                    'slug' => 'kandy-national-museum',
                    'description' => 'Museum displaying artifacts from the Kandyan Kingdom era, including royal regalia, weapons, and historical documents.',
                    'image_url' => 'images/attractions/Kandy-national-museum.jpeg',
                    'rating' => 4.3,
                    'reviews_count' => 534,
                    'entry_fee' => 500,
                    'facilities' => ['restroom', 'guide'],
                    'opening_time' => '09:00:00',
                    'closing_time' => '17:00:00',
                    'is_open_now' => true,
                    'location' => 'Kandy City Center',
                ]);

                Attraction::create([
                    'district_id' => $kandy->id,
                    'category_id' => $culturalCategory->id,
                    'name' => 'Geragama Tea Factory',
                    'slug' => 'geragama-tea-factory',
                    'description' => 'Working tea factory offering guided tours of tea production process from leaf to cup, with tasting sessions.',
                    'image_url' => 'images/attractions/Geragama-tea-factory.jpeg',
                    'rating' => 4.4,
                    'reviews_count' => 445,
                    'entry_fee' => 300,
                    'facilities' => ['parking', 'restroom'],
                    'opening_time' => '08:00:00',
                    'closing_time' => '17:00:00',
                    'is_open_now' => true,
                    'location' => 'Teldeniya, Kandy',
                ]);
            }
        }
    }
}
