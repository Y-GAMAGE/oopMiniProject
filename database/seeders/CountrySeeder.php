<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Sri Lanka',
                'slug' => 'sri-lanka',
                'description' => 'Sri Lanka is an island nation in South Asia, known for its rich cultural heritage, beautiful beaches, ancient temples, and diverse wildlife. Experience tea plantations, historic sites, and warm hospitality.',
                'tagline' => 'The Pearl of the Indian Ocean',
                'continent' => 'Asia',
                'districts_count' => 25,
                'popular_categories' => 'Beaches, Temples, Wildlife',
                'languages' => 'Sinhala, Tamil, English',
                'currency' => 'Sri Lankan Rupee (LKR)',
                'image_url' =>'images/countries/sri-lanka.jpeg'
            ],
            [
                'name' => 'Japan',
                'slug' => 'japan',
                'description' => 'Experience the perfect blend of ancient traditions and cutting-edge technology. From cherry blossoms to bullet trains, Japan offers unforgettable experiences with its unique culture, cuisine, and natural beauty.',
                'tagline' => 'Land of Rising Sun',
                'continent' => 'Asia',
                'districts_count' => 47,
                'popular_categories' => 'Culture, Technology, Gardens',
                'languages' => 'Japanese',
                'currency' => 'Japanese Yen (¥)',
                'image_url' => 'images/countries/Japan.jpeg'
            ],
            [
                'name' => 'France',
                'slug' => 'france',
                'description' => 'Discover the romance of Paris, the lavender fields of Provence, and world-class cuisine. France captivates with its art, culture, and natural beauty from the Alps to the Mediterranean coast.',
                'tagline' => 'City of Love and Light',
                'continent' => 'Europe',
                'districts_count' => 101,
                'popular_categories' => 'Art, Cuisine, Romance',
                'languages' => 'French',
                'currency' => 'Euro (€)',
                'image_url' => 'images/countries/France.jpeg'
            ],
            [
                'name' => 'Brazil',
                'slug' => 'brazil',
                'description' => 'Experience vibrant culture, stunning beaches, and the Amazon rainforest. Brazil pulses with energy, music, and natural wonders. From Rio\'s carnival to São Paulo\'s cosmopolitan charm.',
                'tagline' => 'Land of Carnival',
                'continent' => 'Americas',
                'districts_count' => 26,
                'popular_categories' => 'Beaches, Carnival, Nature',
                'languages' => 'Portuguese',
                'currency' => 'Brazilian Real (R$)',
                'image_url' => 'images/countries/Brazil.jpeg'
            ],
            [
                'name' => 'Australia',
                'slug' => 'australia',
                'description' => 'Explore the land Down Under with its unique wildlife, beautiful beaches, and the iconic Outback. Adventure awaits with the Great Barrier Reef, Sydney Opera House, and diverse landscapes.',
                'tagline' => 'Land Down Under',
                'continent' => 'Oceania',
                'districts_count' => 8,
                'popular_categories' => 'Wildlife, Beaches, Outback',
                'languages' => 'English',
                'currency' => 'Australian Dollar (A$)',
                'image_url' => 'images/countries/Australia.jpeg'
            ],
            [
                'name' => 'Germany',
                'slug' => 'germany',
                'description' => 'Discover fairy-tale castles, historic cities, and the famous Autobahn. Germany combines rich history with modern innovation, from Bavarian Alps to Berlin\'s vibrant culture.',
                'tagline' => 'Land of Innovation',
                'continent' => 'Europe',
                'districts_count' => 16,
                'popular_categories' => 'Castles, History, Beer',
                'languages' => 'German',
                'currency' => 'Euro (€)',
                'image_url' => 'images/countries/Germany.jpeg'
            ],
            [
                'name' => 'Thailand',
                'slug' => 'thailand',
                'description' => 'Experience golden temples, tropical beaches, and world-renowned cuisine. Thailand offers warm hospitality and unforgettable adventures from Bangkok\'s bustle to island paradises.',
                'tagline' => 'Land of Smiles',
                'continent' => 'Asia',
                'districts_count' => 77,
                'popular_categories' => 'Temples, Beaches, Food',
                'languages' => 'Thai',
                'currency' => 'Thai Baht (฿)',
                'image_url' => 'images/countries/Thailand.jpeg'
            ],
            [
                'name' => 'Italy',
                'slug' => 'italy',
                'description' => 'Immerse yourself in Renaissance art, ancient ruins, and exquisite cuisine. Italy is a treasure trove of culture and beauty from Rome to Venice, Florence to the Amalfi Coast.',
                'tagline' => 'Cradle of Renaissance',
                'continent' => 'Europe',
                'districts_count' => 20,
                'popular_categories' => 'Art, History, Cuisine',
                'languages' => 'Italian',
                'currency' => 'Euro (€)',
                'image_url' => 'images/countries/Italy.jpeg'
            ],
            [
                'name' => 'Greece',
                'slug' => 'greece',
                'description' => 'Walk through ancient history, relax on stunning islands, and savor Mediterranean flavors. Greece is where mythology meets reality with the Acropolis, Santorini, and Mykonos.',
                'tagline' => 'Cradle of Civilization',
                'continent' => 'Europe',
                'districts_count' => 13,
                'popular_categories' => 'History, Islands, Mythology',
                'languages' => 'Greek',
                'currency' => 'Euro (€)',
                'image_url' => 'images/countries/Greece.jpeg'
            ],
            [
                'name' => 'United Kingdom',
                'slug' => 'united-kingdom',
                'description' => 'Explore royal palaces, historic universities, and diverse landscapes. The UK blends tradition with contemporary culture from London\'s landmarks to Scottish Highlands.',
                'tagline' => 'Land of Heritage',
                'continent' => 'Europe',
                'districts_count' => 48,
                'popular_categories' => 'Royalty, History, Culture',
                'languages' => 'English',
                'currency' => 'Pound Sterling (£)',
                'image_url' => 'images/countries/UK.jpeg'
            ],
            [
                'name' => 'Spain',
                'slug' => 'spain',
                'description' => 'Experience flamenco, tapas, and stunning architecture. Spain captivates with its passion, art, and Mediterranean charm from Barcelona\'s Gaudí to Andalusia\'s beauty.',
                'tagline' => 'Land of Passion',
                'continent' => 'Europe',
                'districts_count' => 50,
                'popular_categories' => 'Flamenco, Architecture, Beaches',
                'languages' => 'Spanish',
                'currency' => 'Euro (€)',
                'image_url' => 'images/countries/Spain.jpeg'
            ],
            [
                'name' => 'United States',
                'slug' => 'united-states',
                'description' => 'From the Grand Canyon to New York City, explore diverse landscapes and vibrant cities. The USA offers endless possibilities with national parks, cultural diversity, and innovation.',
                'tagline' => 'Land of Opportunity',
                'continent' => 'Americas',
                'districts_count' => 50,
                'popular_categories' => 'National Parks, Cities, Diversity',
                'languages' => 'English',
                'currency' => 'US Dollar ($)',
                'image_url' => 'images/countries/US.jpeg'
            ],
            [
                'name' => 'Canada',
                'slug' => 'canada',
                'description' => 'Discover pristine wilderness, multicultural cities, and friendly locals. Canada offers natural beauty and urban sophistication from the Rockies to Niagara Falls.',
                'tagline' => 'Great White North',
                'continent' => 'Americas',
                'districts_count' => 13,
                'popular_categories' => 'Nature, Wildlife, Mountains',
                'languages' => 'English, French',
                'currency' => 'Canadian Dollar (C$)',
                'image_url' => 'images/countries/Canada.jpeg'
            ],
            [
                'name' => 'New Zealand',
                'slug' => 'new-zealand',
                'description' => 'Experience breathtaking landscapes, adventure sports, and Maori culture. New Zealand is a paradise for nature lovers with fjords, mountains, and pristine beaches.',
                'tagline' => 'Land of Long White Cloud',
                'continent' => 'Oceania',
                'districts_count' => 16,
                'popular_categories' => 'Adventure, Nature, Culture',
                'languages' => 'English, Maori',
                'currency' => 'New Zealand Dollar (NZ$)',
                'image_url' => 'images/countries/NewZealand.jpeg'
            ],
            [
                'name' => 'South Africa',
                'slug' => 'south-africa',
                'description' => 'Witness incredible wildlife, stunning coastlines, and vibrant cities. South Africa offers diverse experiences from safari adventures to Cape Town\'s beauty and rich culture.',
                'tagline' => 'Rainbow Nation',
                'continent' => 'Africa',
                'districts_count' => 9,
                'popular_categories' => 'Safari, Wildlife, Beaches',
                'languages' => 'Afrikaans, English, Zulu',
                'currency' => 'South African Rand (R)',
                'image_url' => 'images/countries/SouthAfrica.jpeg'
            ],
            [
                'name' => 'India',
                'slug' => 'india',
                'description' => 'Explore ancient temples, vibrant festivals, and diverse landscapes. India is a sensory journey through history and culture from the Taj Mahal to Kerala\'s backwaters.',
                'tagline' => 'Land of Diversity',
                'continent' => 'Asia',
                'districts_count' => 28,
                'popular_categories' => 'Temples, Culture, Festivals',
                'languages' => 'Hindi, English',
                'currency' => 'Indian Rupee (₹)',
                'image_url' => 'images/countries/India.jpeg'
            ],
            [
                'name' => 'China',
                'slug' => 'china',
                'description' => 'Discover the Great Wall, terracotta warriors, and modern megacities. China blends ancient wonders with futuristic innovation from Beijing to Shanghai.',
                'tagline' => 'Middle Kingdom',
                'continent' => 'Asia',
                'districts_count' => 34,
                'popular_categories' => 'History, Culture, Modern Cities',
                'languages' => 'Mandarin Chinese',
                'currency' => 'Chinese Yuan (¥)',
                'image_url' => 'images/countries/China.jpeg'
            ],
            [
                'name' => 'Mexico',
                'slug' => 'mexico',
                'description' => 'Experience colorful culture, ancient ruins, and beautiful beaches. Mexico offers rich history and warm hospitality from Aztec pyramids to Cancun\'s shores.',
                'tagline' => 'Land of Aztecs',
                'continent' => 'Americas',
                'districts_count' => 32,
                'popular_categories' => 'Ruins, Beaches, Cuisine',
                'languages' => 'Spanish',
                'currency' => 'Mexican Peso (MX$)',
                'image_url' => 'images/countries/Mexico.jpeg'
            ],
            [
                'name' => 'Egypt',
                'slug' => 'egypt',
                'description' => 'Walk among pyramids, cruise the Nile, and explore ancient tombs. Egypt is a living museum of human civilization with pharaohs\' legacy and desert wonders.',
                'tagline' => 'Land of Pharaohs',
                'continent' => 'Africa',
                'districts_count' => 27,
                'popular_categories' => 'Pyramids, History, Desert',
                'languages' => 'Arabic',
                'currency' => 'Egyptian Pound (E£)',
                'image_url' => 'images/countries/Egypt.jpeg'
            ],
            [
                'name' => 'Turkey',
                'slug' => 'turkey',
                'description' => 'Discover where East meets West, with stunning mosques, bazaars, and coastal beauty. Turkey bridges two continents with Istanbul\'s magic and Cappadocia\'s balloons.',
                'tagline' => 'Bridge Between Continents',
                'continent' => 'Asia',
                'districts_count' => 81,
                'popular_categories' => 'Mosques, Bazaars, Coastline',
                'languages' => 'Turkish',
                'currency' => 'Turkish Lira (₺)',
                'image_url' => 'images/countries/Turkey.jpeg'
            ],
            [
                'name' => 'Indonesia',
                'slug' => 'indonesia',
                'description' => 'Explore thousands of islands, ancient temples, and diverse cultures. Indonesia is an archipelago of wonders from Bali\'s beauty to Jakarta\'s energy.',
                'tagline' => 'Emerald Equator',
                'continent' => 'Asia',
                'districts_count' => 34,
                'popular_categories' => 'Islands, Temples, Beaches',
                'languages' => 'Indonesian',
                'currency' => 'Indonesian Rupiah (Rp)',
                'image_url' => 'images/countries/Indonesia.jpeg'
            ],
            [
                'name' => 'Morocco',
                'slug' => 'morocco',
                'description' => 'Wander through colorful souks, sahara deserts, and coastal cities. Morocco enchants with its exotic charm from Marrakech\'s medina to Casablanca\'s elegance.',
                'tagline' => 'Gateway to Africa',
                'continent' => 'Africa',
                'districts_count' => 12,
                'popular_categories' => 'Souks, Desert, Culture',
                'languages' => 'Arabic, French',
                'currency' => 'Moroccan Dirham (MAD)',
                'image_url' => 'images/countries/Morocco.jpeg'
            ],
            [
                'name' => 'Peru',
                'slug' => 'peru',
                'description' => 'Trek to Machu Picchu, explore the Amazon, and taste incredible cuisine. Peru is a land of ancient mysteries with Incan heritage and natural wonders.',
                'tagline' => 'Land of Incas',
                'continent' => 'Americas',
                'districts_count' => 25,
                'popular_categories' => 'Machu Picchu, History, Cuisine',
                'languages' => 'Spanish, Quechua',
                'currency' => 'Peruvian Sol (S/)',
                'image_url' => 'images/countries/Peru.jpeg'
            ],
            [
                'name' => 'Norway',
                'slug' => 'norway',
                'description' => 'Experience majestic fjords, northern lights, and Viking heritage. Norway showcases nature at its most dramatic with stunning landscapes and Nordic culture.',
                'tagline' => 'Land of Fjords',
                'continent' => 'Europe',
                'districts_count' => 11,
                'popular_categories' => 'Fjords, Northern Lights, Nature',
                'languages' => 'Norwegian',
                'currency' => 'Norwegian Krone (kr)',
                'image_url' => 'images/countries/Norway.jpeg'
            ],
            [
                'name' => 'Iceland',
                'slug' => 'iceland',
                'description' => 'Witness geysers, glaciers, and the aurora borealis. Iceland is a land of fire and ice with volcanic landscapes, hot springs, and unique Nordic charm.',
                'tagline' => 'Land of Fire and Ice',
                'continent' => 'Europe',
                'districts_count' => 8,
                'popular_categories' => 'Geysers, Aurora, Glaciers',
                'languages' => 'Icelandic',
                'currency' => 'Icelandic Króna (kr)',
                'image_url' => 'images/countries/Iceland.jpeg'
            ],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
