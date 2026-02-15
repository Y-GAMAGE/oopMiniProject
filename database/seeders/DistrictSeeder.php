<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all()->keyBy('slug');

        $districtsData = [
            // SRI LANKA - 25 Districts
            'sri-lanka' => [
                ['name' => 'Colombo', 'region' => 'Western Province', 'description' => 'Bustling capital with colonial architecture and beaches', 'attractions_count' => 85, 'best_season' => 'Dec - Apr', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1591192718925-76b7f7c04bc8?w=800'],
                ['name' => 'Kandy', 'region' => 'Central Province', 'description' => 'Cultural capital with Temple of the Tooth', 'attractions_count' => 72, 'best_season' => 'Dec - Apr', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800'],
                ['name' => 'Galle', 'region' => 'Southern Province', 'description' => 'Historic fort city with Dutch colonial architecture', 'attractions_count' => 68, 'best_season' => 'Nov - Apr', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1568322445389-f64ac2515020?w=800'],
                ['name' => 'Nuwara Eliya', 'region' => 'Central Province', 'description' => 'Hill country with tea plantations', 'attractions_count' => 54, 'best_season' => 'Apr - Sep', 'total_categories' => 4, 'image_url' => 'https://images.unsplash.com/photo-1593989481974-d0b27c6d1f38?w=800'],
                ['name' => 'Anuradhapura', 'region' => 'North Central', 'description' => 'Ancient city with sacred Buddhist sites', 'attractions_count' => 61, 'best_season' => 'May - Sep', 'total_categories' => 3, 'image_url' => 'https://images.unsplash.com/photo-1588591795084-1770cb3be374?w=800'],
                ['name' => 'Ella', 'region' => 'Uva Province', 'description' => 'Mountain paradise with stunning viewpoints', 'attractions_count' => 42, 'best_season' => 'Dec - Mar', 'total_categories' => 4, 'image_url' => 'https://images.unsplash.com/photo-1604486881548-0b9dc87f7c9b?w=800'],
                ['name' => 'Jaffna', 'region' => 'Northern Province', 'description' => 'Cultural heartland with Tamil heritage', 'attractions_count' => 45, 'best_season' => 'Dec - Sep', 'total_categories' => 4, 'image_url' => 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800'],
                ['name' => 'Bentota', 'region' => 'Southern Province', 'description' => 'Beach resort with water sports', 'attractions_count' => 35, 'best_season' => 'Nov - Apr', 'total_categories' => 3, 'image_url' => 'https://images.unsplash.com/photo-1580541631950-7282082b53ce?w=800'],
                ['name' => 'Sigiriya', 'region' => 'Central Province', 'description' => 'Ancient rock fortress UNESCO site', 'attractions_count' => 38, 'best_season' => 'Jan - Apr', 'total_categories' => 3, 'image_url' => 'https://images.unsplash.com/photo-1595433707802-6b2626ef1c91?w=800'],
            ],

            // JAPAN - 47 Prefectures
            'japan' => [
                ['name' => 'Tokyo', 'region' => 'Prefecture', 'description' => 'Modern metropolis blending tradition with technology', 'attractions_count' => 156, 'best_season' => 'Mar - May', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800'],
                ['name' => 'Kyoto', 'region' => 'Prefecture', 'description' => 'Ancient capital with thousands of temples', 'attractions_count' => 142, 'best_season' => 'Mar - May', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=800'],
                ['name' => 'Osaka', 'region' => 'Prefecture', 'description' => 'Culinary capital with vibrant street food', 'attractions_count' => 128, 'best_season' => 'Mar - May', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1590559899731-a382839e5549?w=800'],
                ['name' => 'Hokkaido', 'region' => 'Prefecture', 'description' => 'Northern island with skiing and hot springs', 'attractions_count' => 98, 'best_season' => 'Dec - Feb', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1559494007-9f5847c49d94?w=800'],
                ['name' => 'Hiroshima', 'region' => 'Prefecture', 'description' => 'Peace memorial city with historic significance', 'attractions_count' => 76, 'best_season' => 'Mar - May', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1583407723901-d1d9257a6e81?w=800'],
                ['name' => 'Nara', 'region' => 'Prefecture', 'description' => 'Ancient city with friendly deer and temples', 'attractions_count' => 85, 'best_season' => 'Mar - May', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=800'],
                ['name' => 'Okinawa', 'region' => 'Prefecture', 'description' => 'Tropical paradise with unique culture', 'attractions_count' => 67, 'best_season' => 'Apr - Jun', 'total_categories' => 4, 'image_url' => 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?w=800'],
                ['name' => 'Fukuoka', 'region' => 'Prefecture', 'description' => 'Modern city with ramen culture', 'attractions_count' => 72, 'best_season' => 'Mar - May', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800'],
                ['name' => 'Yokohama', 'region' => 'Prefecture', 'description' => 'Port city with Chinatown', 'attractions_count' => 89, 'best_season' => 'Mar - May', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1617552064513-b55e0c5448b9?w=800'],
            ],

            // FRANCE - 18 Regions
            'france' => [
                ['name' => 'Île-de-France', 'region' => 'Region', 'description' => 'Paris region with iconic landmarks', 'attractions_count' => 287, 'best_season' => 'Apr - Jun', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800'],
                ['name' => 'Provence-Alpes-Côte d\'Azur', 'region' => 'Region', 'description' => 'Mediterranean coast with lavender fields', 'attractions_count' => 198, 'best_season' => 'May - Sep', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?w=800'],
                ['name' => 'Auvergne-Rhône-Alpes', 'region' => 'Region', 'description' => 'Alpine region with skiing', 'attractions_count' => 176, 'best_season' => 'Dec - Mar', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1605649487212-47bdab064df7?w=800'],
                ['name' => 'Occitanie', 'region' => 'Region', 'description' => 'Southern France with medieval towns', 'attractions_count' => 154, 'best_season' => 'May - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1558517259-165ae4b10151?w=800'],
                ['name' => 'Nouvelle-Aquitaine', 'region' => 'Region', 'description' => 'Atlantic coast with wine regions', 'attractions_count' => 142, 'best_season' => 'May - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1595433562696-a8a91a01c31e?w=800'],
                ['name' => 'Brittany', 'region' => 'Region', 'description' => 'Celtic heritage with rugged coastline', 'attractions_count' => 128, 'best_season' => 'Jun - Sep', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1563911892437-1feda0179e1b?w=800'],
                ['name' => 'Normandy', 'region' => 'Region', 'description' => 'Historic D-Day beaches and Mont-Saint-Michel', 'attractions_count' => 135, 'best_season' => 'May - Sep', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1583070039360-d4d077c45c3d?w=800'],
                ['name' => 'Grand Est', 'region' => 'Region', 'description' => 'Champagne region and Alsatian villages', 'attractions_count' => 119, 'best_season' => 'Apr - Oct', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1556983852-43bf21186b2b?w=800'],
                ['name' => 'Corsica', 'region' => 'Region', 'description' => 'Mediterranean island with mountains', 'attractions_count' => 87, 'best_season' => 'May - Sep', 'total_categories' => 4, 'image_url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800'],
            ],

            // BRAZIL - 26 States
            'brazil' => [
                ['name' => 'Rio de Janeiro', 'region' => 'State', 'description' => 'Iconic beaches and Christ the Redeemer', 'attractions_count' => 195, 'best_season' => 'Dec - Mar', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1483729558449-99ef09a8c325?w=800'],
                ['name' => 'São Paulo', 'region' => 'State', 'description' => 'Mega-city with culture and dining', 'attractions_count' => 243, 'best_season' => 'Apr - Nov', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1548963670-aaaa8f73a5e9?w=800'],
                ['name' => 'Bahia', 'region' => 'State', 'description' => 'Salvador beaches and Afro-Brazilian culture', 'attractions_count' => 167, 'best_season' => 'Dec - Mar', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1589394815804-964ed0be2eb5?w=800'],
                ['name' => 'Amazonas', 'region' => 'State', 'description' => 'Amazon rainforest and Manaus', 'attractions_count' => 134, 'best_season' => 'Jun - Nov', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800'],
                ['name' => 'Minas Gerais', 'region' => 'State', 'description' => 'Colonial towns and baroque architecture', 'attractions_count' => 156, 'best_season' => 'Apr - Oct', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1575407520481-ff82f7e86e39?w=800'],
                ['name' => 'Santa Catarina', 'region' => 'State', 'description' => 'Beach resorts and German heritage', 'attractions_count' => 128, 'best_season' => 'Dec - Mar', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800'],
                ['name' => 'Pernambuco', 'region' => 'State', 'description' => 'Recife beaches and historic Olinda', 'attractions_count' => 142, 'best_season' => 'Sep - Mar', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1578070181910-f1e514afdd08?w=800'],
                ['name' => 'Ceará', 'region' => 'State', 'description' => 'Fortaleza beaches and sand dunes', 'attractions_count' => 119, 'best_season' => 'Jul - Dec', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1588282558358-03d3c1a3e7f7?w=800'],
                ['name' => 'Paraná', 'region' => 'State', 'description' => 'Iguazu Falls and Curitiba parks', 'attractions_count' => 145, 'best_season' => 'Apr - Oct', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=800'],
            ],

            // AUSTRALIA - 8 States
            'australia' => [
                ['name' => 'New South Wales', 'region' => 'State', 'description' => 'Sydney harbor and Blue Mountains', 'attractions_count' => 234, 'best_season' => 'Sep - Nov', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?w=800'],
                ['name' => 'Victoria', 'region' => 'State', 'description' => 'Melbourne culture and Great Ocean Road', 'attractions_count' => 198, 'best_season' => 'Mar - May', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1514395462725-fb4566210144?w=800'],
                ['name' => 'Queensland', 'region' => 'State', 'description' => 'Great Barrier Reef and tropical islands', 'attractions_count' => 187, 'best_season' => 'Apr - Oct', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800'],
                ['name' => 'Western Australia', 'region' => 'State', 'description' => 'Perth and pristine beaches', 'attractions_count' => 156, 'best_season' => 'Sep - Nov', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1568322445389-f64ac2515020?w=800'],
                ['name' => 'South Australia', 'region' => 'State', 'description' => 'Adelaide and wine valleys', 'attractions_count' => 143, 'best_season' => 'Mar - May', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?w=800'],
                ['name' => 'Tasmania', 'region' => 'State', 'description' => 'Wild nature and pristine wilderness', 'attractions_count' => 98, 'best_season' => 'Dec - Feb', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1583541508378-fe23f5f44061?w=800'],
                ['name' => 'Northern Territory', 'region' => 'Territory', 'description' => 'Uluru and Aboriginal culture', 'attractions_count' => 76, 'best_season' => 'May - Sep', 'total_categories' => 4, 'image_url' => 'https://images.unsplash.com/photo-1588279941123-1d72b0984d96?w=800'],
                ['name' => 'Australian Capital Territory', 'region' => 'Territory', 'description' => 'Canberra and national museums', 'attractions_count' => 54, 'best_season' => 'Sep - Nov', 'total_categories' => 4, 'image_url' => 'https://images.unsplash.com/photo-1598948485421-33a1655d3c18?w=800'],
            ],

            // GERMANY - 16 States
            'germany' => [
                ['name' => 'Bavaria', 'region' => 'State', 'description' => 'Munich, Alps, and Oktoberfest', 'attractions_count' => 234, 'best_season' => 'May - Sep', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1595855759920-86582396756a?w=800'],
                ['name' => 'Berlin', 'region' => 'State', 'description' => 'Capital with rich history', 'attractions_count' => 289, 'best_season' => 'May - Sep', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1560930950-5cc20e80e392?w=800'],
                ['name' => 'Hamburg', 'region' => 'State', 'description' => 'Port city with maritime heritage', 'attractions_count' => 176, 'best_season' => 'May - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1558517259-165ae4b10151?w=800'],
                ['name' => 'Baden-Württemberg', 'region' => 'State', 'description' => 'Black Forest region', 'attractions_count' => 198, 'best_season' => 'May - Oct', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=800'],
            ],

            // THAILAND - 77 Provinces
            'thailand' => [
                ['name' => 'Bangkok', 'region' => 'Province', 'description' => 'Vibrant capital with temples', 'attractions_count' => 312, 'best_season' => 'Nov - Feb', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=800'],
                ['name' => 'Phuket', 'region' => 'Province', 'description' => 'Island paradise with beaches', 'attractions_count' => 187, 'best_season' => 'Nov - Apr', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1589394815804-964ed0be2eb5?w=800'],
                ['name' => 'Chiang Mai', 'region' => 'Province', 'description' => 'Northern cultural hub', 'attractions_count' => 165, 'best_season' => 'Nov - Feb', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800'],
                ['name' => 'Krabi', 'region' => 'Province', 'description' => 'Limestone cliffs and beaches', 'attractions_count' => 143, 'best_season' => 'Nov - Apr', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800'],
            ],

            // ITALY - 20 Regions
            'italy' => [
                ['name' => 'Lazio', 'region' => 'Region', 'description' => 'Rome and ancient sites', 'attractions_count' => 345, 'best_season' => 'Apr - Jun', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=800'],
                ['name' => 'Tuscany', 'region' => 'Region', 'description' => 'Florence and wine country', 'attractions_count' => 289, 'best_season' => 'Apr - Jun', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=800'],
                ['name' => 'Veneto', 'region' => 'Region', 'description' => 'Venice canals and gondolas', 'attractions_count' => 256, 'best_season' => 'Apr - Jun', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1514890547357-a9ee288728e0?w=800'],
                ['name' => 'Sicily', 'region' => 'Region', 'description' => 'Island with Greek ruins', 'attractions_count' => 198, 'best_season' => 'Apr - Jun', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1555992336-fb0d29498b13?w=800'],
            ],

            // GREECE - 13 Regions
            'greece' => [
                ['name' => 'Attica', 'region' => 'Region', 'description' => 'Athens and the Acropolis', 'attractions_count' => 234, 'best_season' => 'Apr - Jun', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1555993539-1732b0258235?w=800'],
                ['name' => 'Crete', 'region' => 'Region', 'description' => 'Largest island with Minoan ruins', 'attractions_count' => 187, 'best_season' => 'May - Oct', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?w=800'],
                ['name' => 'Santorini', 'region' => 'Island', 'description' => 'White-washed villages', 'attractions_count' => 156, 'best_season' => 'Apr - Oct', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?w=800'],
            ],

            // UNITED KINGDOM - 4 Countries
            'united-kingdom' => [
                ['name' => 'England', 'region' => 'Country', 'description' => 'London and historic cities', 'attractions_count' => 456, 'best_season' => 'May - Sep', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=800'],
                ['name' => 'Scotland', 'region' => 'Country', 'description' => 'Edinburgh and Highlands', 'attractions_count' => 234, 'best_season' => 'May - Sep', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1486299267070-83823f5448dd?w=800'],
                ['name' => 'Wales', 'region' => 'Country', 'description' => 'Cardiff and castles', 'attractions_count' => 167, 'best_season' => 'May - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1585159812596-fca9bb4c6e5c?w=800'],
                ['name' => 'Northern Ireland', 'region' => 'Country', 'description' => 'Belfast and Giant\'s Causeway', 'attractions_count' => 98, 'best_season' => 'May - Sep', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1590507182485-e328fc2bfd14?w=800'],
            ],

            // SPAIN - 17 Regions
            'spain' => [
                ['name' => 'Catalonia', 'region' => 'Region', 'description' => 'Barcelona and Mediterranean coast', 'attractions_count' => 298, 'best_season' => 'May - Sep', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1562883676-8c7feb83f09b?w=800'],
                ['name' => 'Madrid', 'region' => 'Region', 'description' => 'Capital with royal palaces', 'attractions_count' => 267, 'best_season' => 'Mar - Jun', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=800'],
                ['name' => 'Andalusia', 'region' => 'Region', 'description' => 'Flamenco and Moorish architecture', 'attractions_count' => 245, 'best_season' => 'Mar - Jun', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1558642084-fd07fae5282e?w=800'],
                ['name' => 'Balearic Islands', 'region' => 'Region', 'description' => 'Ibiza and beach resorts', 'attractions_count' => 176, 'best_season' => 'May - Sep', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1542229246-0c80e0a51f4e?w=800'],
            ],

            // UNITED STATES - 50 States
            'united-states' => [
                ['name' => 'California', 'region' => 'State', 'description' => 'Golden State with beaches and tech', 'attractions_count' => 567, 'best_season' => 'Mar - May', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1485738422979-f5c462d49f74?w=800'],
                ['name' => 'New York', 'region' => 'State', 'description' => 'NYC and Niagara Falls', 'attractions_count' => 489, 'best_season' => 'Apr - Jun', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=800'],
                ['name' => 'Florida', 'region' => 'State', 'description' => 'Theme parks and tropical beaches', 'attractions_count' => 423, 'best_season' => 'Nov - Apr', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1561138643-3818e50e7df4?w=800'],
                ['name' => 'Texas', 'region' => 'State', 'description' => 'Big cities and cowboy culture', 'attractions_count' => 398, 'best_season' => 'Mar - May', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1531218150217-54595bc2b934?w=800'],
                ['name' => 'Hawaii', 'region' => 'State', 'description' => 'Tropical paradise with volcanoes', 'attractions_count' => 287, 'best_season' => 'Apr - Oct', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1542259009477-d625272157b7?w=800'],
                ['name' => 'Nevada', 'region' => 'State', 'description' => 'Las Vegas entertainment', 'attractions_count' => 256, 'best_season' => 'Mar - May', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1605833556294-ea5c7a74f97a?w=800'],
                ['name' => 'Arizona', 'region' => 'State', 'description' => 'Grand Canyon and desert beauty', 'attractions_count' => 234, 'best_season' => 'Mar - May', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1517462964-21fdcec3f25b?w=800'],
                ['name' => 'Colorado', 'region' => 'State', 'description' => 'Rocky Mountains and ski resorts', 'attractions_count' => 298, 'best_season' => 'Jun - Sep', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1542223616-9de9adb5e3e8?w=800'],
                ['name' => 'Washington', 'region' => 'State', 'description' => 'Seattle and Mount Rainier', 'attractions_count' => 267, 'best_season' => 'Jun - Sep', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1516963126209-02cb62412a41?w=800'],
            ],

            // CANADA - 13 Provinces
            'canada' => [
                ['name' => 'Ontario', 'region' => 'Province', 'description' => 'Toronto and Niagara Falls', 'attractions_count' => 345, 'best_season' => 'May - Sep', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1517935706615-2717063c2225?w=800'],
                ['name' => 'Quebec', 'region' => 'Province', 'description' => 'Montreal and French culture', 'attractions_count' => 298, 'best_season' => 'May - Sep', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1519643381401-22c77e60520e?w=800'],
                ['name' => 'British Columbia', 'region' => 'Province', 'description' => 'Vancouver and Rocky Mountains', 'attractions_count' => 267, 'best_season' => 'Jun - Sep', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1503614472-8c93d56e92ce?w=800'],
                ['name' => 'Alberta', 'region' => 'Province', 'description' => 'Calgary and Banff National Park', 'attractions_count' => 234, 'best_season' => 'Jun - Sep', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1503275833151-1c4c6382f7e3?w=800'],
            ],

            // NEW ZEALAND - 16 Regions
            'new-zealand' => [
                ['name' => 'Auckland', 'region' => 'Region', 'description' => 'City of Sails with harbors', 'attractions_count' => 187, 'best_season' => 'Dec - Feb', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1507699622108-4be3abd695ad?w=800'],
                ['name' => 'Queenstown', 'region' => 'Region', 'description' => 'Adventure capital', 'attractions_count' => 165, 'best_season' => 'Dec - Feb', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800'],
                ['name' => 'Wellington', 'region' => 'Region', 'description' => 'Capital with culture', 'attractions_count' => 143, 'best_season' => 'Dec - Feb', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1521711389101-d13da97d01d5?w=800'],
                ['name' => 'Canterbury', 'region' => 'Region', 'description' => 'Christchurch and Alps', 'attractions_count' => 156, 'best_season' => 'Dec - Feb', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1503891617560-5b8c2e28cbf6?w=800'],
            ],

            // SOUTH AFRICA - 9 Provinces
            'south-africa' => [
                ['name' => 'Western Cape', 'region' => 'Province', 'description' => 'Cape Town and winelands', 'attractions_count' => 234, 'best_season' => 'Nov - Mar', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1580060839134-75a5edca2e99?w=800'],
                ['name' => 'Gauteng', 'region' => 'Province', 'description' => 'Johannesburg and Pretoria', 'attractions_count' => 198, 'best_season' => 'Apr - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1577948000111-9c970dfe3743?w=800'],
                ['name' => 'KwaZulu-Natal', 'region' => 'Province', 'description' => 'Durban beaches', 'attractions_count' => 176, 'best_season' => 'Apr - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1484318571209-661cf29a69c3?w=800'],
            ],

            // INDIA - 28 States
            'india' => [
                ['name' => 'Rajasthan', 'region' => 'State', 'description' => 'Desert palaces and colorful culture', 'attractions_count' => 234, 'best_season' => 'Oct - Mar', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=800'],
                ['name' => 'Kerala', 'region' => 'State', 'description' => 'Backwaters and Ayurveda', 'attractions_count' => 198, 'best_season' => 'Sep - Mar', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?w=800'],
                ['name' => 'Goa', 'region' => 'State', 'description' => 'Beach paradise with Portuguese heritage', 'attractions_count' => 156, 'best_season' => 'Nov - Feb', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?w=800'],
                ['name' => 'Uttarakhand', 'region' => 'State', 'description' => 'Himalayan state with yoga', 'attractions_count' => 187, 'best_season' => 'Mar - Jun', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?w=800'],
                ['name' => 'Maharashtra', 'region' => 'State', 'description' => 'Mumbai and Bollywood', 'attractions_count' => 267, 'best_season' => 'Oct - Feb', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=800'],
                ['name' => 'Tamil Nadu', 'region' => 'State', 'description' => 'Temples and South Indian culture', 'attractions_count' => 243, 'best_season' => 'Nov - Feb', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=800'],
                ['name' => 'Karnataka', 'region' => 'State', 'description' => 'Bangalore tech hub', 'attractions_count' => 221, 'best_season' => 'Oct - Feb', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=800'],
                ['name' => 'West Bengal', 'region' => 'State', 'description' => 'Kolkata culture and Darjeeling tea', 'attractions_count' => 198, 'best_season' => 'Oct - Mar', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1558431382-27e303142255?w=800'],
                ['name' => 'Himachal Pradesh', 'region' => 'State', 'description' => 'Hill stations and adventure', 'attractions_count' => 176, 'best_season' => 'Mar - Jun', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?w=800'],
            ],

            // CHINA - 34 Provinces
            'china' => [
                ['name' => 'Beijing', 'region' => 'Municipality', 'description' => 'Capital with Great Wall', 'attractions_count' => 456, 'best_season' => 'Sep - Oct', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1508804185872-d7badad00f7d?w=800'],
                ['name' => 'Shanghai', 'region' => 'Municipality', 'description' => 'Modern metropolis', 'attractions_count' => 398, 'best_season' => 'Mar - May', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1537973898803-3bd28bfd95e2?w=800'],
                ['name' => 'Guangdong', 'region' => 'Province', 'description' => 'Canton and Hong Kong border', 'attractions_count' => 345, 'best_season' => 'Oct - Dec', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1570641963303-92ce4845ed4c?w=800'],
                ['name' => 'Sichuan', 'region' => 'Province', 'description' => 'Pandas and spicy cuisine', 'attractions_count' => 298, 'best_season' => 'Mar - Jun', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1529823797322-f5b1a5e33487?w=800'],
            ],

            // MEXICO - 32 States
            'mexico' => [
                ['name' => 'Quintana Roo', 'region' => 'State', 'description' => 'Cancun and Mayan ruins', 'attractions_count' => 234, 'best_season' => 'Dec - Apr', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1518638150340-f706e86654de?w=800'],
                ['name' => 'Mexico City', 'region' => 'Federal District', 'description' => 'Capital with Aztec history', 'attractions_count' => 398, 'best_season' => 'Mar - May', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1568402102990-bc541580b59f?w=800'],
                ['name' => 'Jalisco', 'region' => 'State', 'description' => 'Guadalajara and tequila', 'attractions_count' => 198, 'best_season' => 'Oct - Apr', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1573055418049-2524a42d6d55?w=800'],
                ['name' => 'Yucatan', 'region' => 'State', 'description' => 'Merida and cenotes', 'attractions_count' => 176, 'best_season' => 'Nov - Mar', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=800'],
            ],

            // EGYPT - 27 Governorates
            'egypt' => [
                ['name' => 'Cairo', 'region' => 'Governorate', 'description' => 'Pyramids and ancient wonders', 'attractions_count' => 298, 'best_season' => 'Oct - Apr', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1539650116574-8efeb43e2750?w=800'],
                ['name' => 'Luxor', 'region' => 'Governorate', 'description' => 'Valley of the Kings', 'attractions_count' => 234, 'best_season' => 'Oct - Apr', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1553913861-c0fddf2619ee?w=800'],
                ['name' => 'Aswan', 'region' => 'Governorate', 'description' => 'Nile cruises and temples', 'attractions_count' => 187, 'best_season' => 'Oct - Apr', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?w=800'],
            ],

            // TURKEY - 81 Provinces
            'turkey' => [
                ['name' => 'Istanbul', 'region' => 'Province', 'description' => 'Bridge between Europe and Asia', 'attractions_count' => 398, 'best_season' => 'Apr - May', 'total_categories' => 8, 'image_url' => 'https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?w=800'],
                ['name' => 'Cappadocia', 'region' => 'Region', 'description' => 'Hot air balloons and cave hotels', 'attractions_count' => 234, 'best_season' => 'Apr - Jun', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1541432901042-2d8bd64b4a9b?w=800'],
                ['name' => 'Antalya', 'region' => 'Province', 'description' => 'Turkish Riviera beaches', 'attractions_count' => 198, 'best_season' => 'May - Oct', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1605441387848-1bf0e5b22e86?w=800'],
            ],

            // INDONESIA - 34 Provinces
            'indonesia' => [
                ['name' => 'Bali', 'region' => 'Province', 'description' => 'Island of gods with temples', 'attractions_count' => 298, 'best_season' => 'Apr - Oct', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800'],
                ['name' => 'Jakarta', 'region' => 'Capital', 'description' => 'Bustling capital city', 'attractions_count' => 234, 'best_season' => 'May - Sep', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1555899434-94d1eb5d0e4c?w=800'],
                ['name' => 'Yogyakarta', 'region' => 'Special Region', 'description' => 'Cultural heart with Borobudur', 'attractions_count' => 198, 'best_season' => 'May - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?w=800'],
            ],

            // MOROCCO - 12 Regions
            'morocco' => [
                ['name' => 'Marrakech-Safi', 'region' => 'Region', 'description' => 'Red city with souks', 'attractions_count' => 234, 'best_season' => 'Mar - May', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1509439581779-6298f75bf6e5?w=800'],
                ['name' => 'Fès-Meknès', 'region' => 'Region', 'description' => 'Ancient medina and tanneries', 'attractions_count' => 198, 'best_season' => 'Mar - May', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1515542622106-78bda8ba0e5b?w=800'],
                ['name' => 'Casablanca-Settat', 'region' => 'Region', 'description' => 'Modern city by the sea', 'attractions_count' => 176, 'best_season' => 'Mar - May', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1574873215857-8fd6e3d9024b?w=800'],
            ],

            // PERU - 25 Regions
            'peru' => [
                ['name' => 'Cusco', 'region' => 'Region', 'description' => 'Gateway to Machu Picchu', 'attractions_count' => 267, 'best_season' => 'May - Sep', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?w=800'],
                ['name' => 'Lima', 'region' => 'Region', 'description' => 'Capital with culinary scene', 'attractions_count' => 234, 'best_season' => 'Dec - Apr', 'total_categories' => 7, 'image_url' => 'https://images.unsplash.com/photo-1531968455001-5c5272a41129?w=800'],
                ['name' => 'Arequipa', 'region' => 'Region', 'description' => 'White city with volcanoes', 'attractions_count' => 187, 'best_season' => 'Apr - Nov', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1544376798-89aa6b82c6cd?w=800'],
            ],

            // NORWAY - 11 Counties
            'norway' => [
                ['name' => 'Oslo', 'region' => 'County', 'description' => 'Capital with fjord views', 'attractions_count' => 187, 'best_season' => 'May - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1513519245088-0e12902e35ca?w=800'],
                ['name' => 'Bergen', 'region' => 'County', 'description' => 'Gateway to the fjords', 'attractions_count' => 165, 'best_season' => 'May - Sep', 'total_categories' => 6, 'image_url' => 'https://images.unsplash.com/photo-1517439423365-c28c92e6e3c0?w=800'],
                ['name' => 'Tromsø', 'region' => 'County', 'description' => 'Northern lights capital', 'attractions_count' => 143, 'best_season' => 'Sep - Mar', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1579033461380-adb47c3eb938?w=800'],
            ],

            // ICELAND - 8 Regions
            'iceland' => [
                ['name' => 'Capital Region', 'region' => 'Region', 'description' => 'Reykjavik and Blue Lagoon', 'attractions_count' => 134, 'best_season' => 'Jun - Aug', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1504893524553-b855bce32c67?w=800'],
                ['name' => 'Southern Region', 'region' => 'Region', 'description' => 'Golden Circle and waterfalls', 'attractions_count' => 156, 'best_season' => 'Jun - Aug', 'total_categories' => 5, 'image_url' => 'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?w=800'],
                ['name' => 'Northern Region', 'region' => 'Region', 'description' => 'Akureyri and whale watching', 'attractions_count' => 98, 'best_season' => 'Jun - Aug', 'total_categories' => 4, 'image_url' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=800'],
            ],
        ];

        foreach ($districtsData as $countrySlug => $districts) {
            if (isset($countries[$countrySlug])) {
                $country = $countries[$countrySlug];
                foreach ($districts as $districtData) {
                    District::create([
                        'country_id' => $country->id,
                        'name' => $districtData['name'],
                        'slug' => \Illuminate\Support\Str::slug($districtData['name']),
                        'region' => $districtData['region'],
                        'description' => $districtData['description'],
                        'attractions_count' => $districtData['attractions_count'],
                        'best_season' => $districtData['best_season'],
                        'total_categories' => $districtData['total_categories'],
                        'image_url' => $districtData['image_url'],
                    ]);
                }
            }
        }
    }
}
