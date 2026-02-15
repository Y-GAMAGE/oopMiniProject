<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attraction;

class AttractionDetailsSeeder extends Seeder
{
    public function run(): void
    {
        // Update Temple of the Sacred Tooth Relic
        $toothRelic = Attraction::where('slug', 'temple-of-tooth-relic')->first();
        if ($toothRelic) {
            $toothRelic->update([
                'images' => [
                    'images/attractions/totr/totr1.jpeg',
                    'images/attractions/totr/totr2.jpeg',
                    'images/attractions/totr/totr3.jpeg',
                    'images/attractions/totr/totr4.jpeg',
                    'images/attractions/totr/totr5.jpeg',
                ],
                'tags' => ['UNESCO World Heritage', 'Buddhist Temple', 'Historical Site', 'Cultural Significance', 'Pilgrimage Site'],
                'latitude' => 7.2935,
                'longitude' => 80.6410,
                'address' => 'Sri Dalada Veediya, Kandy 20000, Sri Lanka',
                'phone' => '+94 81 223 4226',
                'email' => 'info@sridaladamaligawa.lk',
                'website' => 'http://www.sridaladamaligawa.lk',
                'best_time_to_visit' => 'Early morning (5:30-8:00 AM) or evening (6:00-7:00 PM) for ceremonies',
                'duration' => '1-2 hours',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Bahiravokanda Vihara
        $bahiravokanda = Attraction::where('slug', 'bahiravokanda-vihara')->first();
        if ($bahiravokanda) {
            $bahiravokanda->update([
                'images' => [
                    'https://images.unsplash.com/photo-1604129712087-7a89f7e1a396?w=800',
                    'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800',
                    'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800',
                ],
                'tags' => ['Buddha Statue', 'City Views', 'Photography', 'Meditation', 'Peaceful'],
                'latitude' => 7.2989,
                'longitude' => 80.6399,
                'address' => 'Bahiravokanda, Kandy, Sri Lanka',
                'phone' => '+94 81 222 3456',
                'best_time_to_visit' => 'Sunset (5:00-6:30 PM) for best city views',
                'duration' => '45 minutes to 1 hour',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Gadaladeniya Temple
        $gadaladeniya = Attraction::where('slug', 'gadaladeniya-temple')->first();
        if ($gadaladeniya) {
            $gadaladeniya->update([
                'images' => [
                    'https://images.unsplash.com/photo-1588415568670-8b3d3f774e3d?w=800',
                    'https://images.unsplash.com/photo-1604129712087-7a89f7e1a396?w=800',
                ],
                'tags' => ['Ancient Temple', 'Architecture', 'Historical', '14th Century', 'Rock Temple'],
                'latitude' => 7.2547,
                'longitude' => 80.5631,
                'address' => 'Pilimathalawa, Kandy, Sri Lanka',
                'phone' => '+94 81 257 8901',
                'best_time_to_visit' => 'Morning (7:00-10:00 AM) to avoid crowds',
                'duration' => '1 hour',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Embekke Devalaya
        $embekke = Attraction::where('slug', 'embekke-devalaya')->first();
        if ($embekke) {
            $embekke->update([
                'images' => [
                    'https://images.unsplash.com/photo-1604129712087-7a89f7e1a396?w=800',
                    'https://images.unsplash.com/photo-1588415568670-8b3d3f774e3d?w=800',
                    'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800',
                ],
                'tags' => ['Wood Carvings', 'Ancient Art', 'Kandyan Architecture', 'Cultural Heritage', 'Hindu Shrine'],
                'latitude' => 7.2156,
                'longitude' => 80.5242,
                'address' => 'Udunuwara, Kandy, Sri Lanka',
                'phone' => '+94 81 257 2345',
                'best_time_to_visit' => 'Morning (8:00-11:00 AM) for better lighting',
                'duration' => '1-1.5 hours',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Lankatilaka Temple
        $lankatilaka = Attraction::where('slug', 'lankatilaka-temple')->first();
        if ($lankatilaka) {
            $lankatilaka->update([
                'images' => [
                    'https://images.unsplash.com/photo-1588415568670-8b3d3f774e3d?w=800',
                    'https://images.unsplash.com/photo-1604129712087-7a89f7e1a396?w=800',
                ],
                'tags' => ['Rock Temple', 'Buddha Statue', 'Murals', 'Ancient', 'Kandyan Era'],
                'latitude' => 7.2339,
                'longitude' => 80.5414,
                'address' => 'Hiripitiya, Kandy, Sri Lanka',
                'phone' => '+94 81 257 4567',
                'best_time_to_visit' => 'Early morning (7:00-9:00 AM)',
                'duration' => '1 hour',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Degaldoruwa Temple
        $degaldoruwa = Attraction::where('slug', 'degaldoruwa-temple')->first();
        if ($degaldoruwa) {
            $degaldoruwa->update([
                'images' => [
                    'https://images.unsplash.com/photo-1604129712087-7a89f7e1a396?w=800',
                    'https://images.unsplash.com/photo-1588415568670-8b3d3f774e3d?w=800',
                ],
                'tags' => ['Cave Temple', 'Frescoes', 'Buddhist Art', '18th Century', 'Paintings'],
                'latitude' => 7.3158,
                'longitude' => 80.6797,
                'address' => 'Degaldoruwa, Kundasale, Sri Lanka',
                'phone' => '+94 81 242 1234',
                'best_time_to_visit' => 'Morning (8:00-11:00 AM)',
                'duration' => '45 minutes',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Royal Botanical Gardens
        $botanicalGardens = Attraction::where('slug', 'royal-botanical-gardens')->first();
        if ($botanicalGardens) {
            $botanicalGardens->update([
                'images' => [
                    'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=800',
                    'https://images.unsplash.com/photo-1597262975002-c5c3b14bbd62?w=800',
                    'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=800',
                    'https://images.unsplash.com/photo-1591857177580-dc82b9ac4e1e?w=800',
                ],
                'tags' => ['Botanical Gardens', 'Nature', 'Orchids', 'Family Friendly', 'Photography', 'Picnic Spot'],
                'latitude' => 7.2699,
                'longitude' => 80.5964,
                'address' => 'Peradeniya, Kandy 20400, Sri Lanka',
                'phone' => '+94 81 238 8249',
                'email' => 'botanicgardens@gmail.com',
                'website' => 'http://botanicgardens.gov.lk',
                'best_time_to_visit' => 'Morning (7:30-10:00 AM) for pleasant weather and fewer crowds',
                'duration' => '2-3 hours',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Udawattakele Forest
        $udawattakele = Attraction::where('slug', 'udawattakele-forest')->first();
        if ($udawattakele) {
            $udawattakele->update([
                'images' => [
                    'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=800',
                    'https://images.unsplash.com/photo-1535320903710-d993d3d77d29?w=800',
                ],
                'tags' => ['Forest Reserve', 'Bird Watching', 'Nature Walk', 'Wildlife', 'Historic'],
                'latitude' => 7.2978,
                'longitude' => 80.6425,
                'address' => 'Sangamitta Mawatha, Kandy, Sri Lanka',
                'phone' => '+94 81 222 3344',
                'best_time_to_visit' => 'Early morning (6:00-8:00 AM) for bird watching',
                'duration' => '2-3 hours',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Kandy Lake
        $kandyLake = Attraction::where('slug', 'kandy-lake')->first();
        if ($kandyLake) {
            $kandyLake->update([
                'images' => [
                    'https://images.unsplash.com/photo-1605649487212-47fbe9e30950?w=800',
                    'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800',
                    'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800',
                ],
                'tags' => ['Lake', 'Scenic Walk', 'City Center', 'Landmark', 'Photography', 'Relaxation'],
                'latitude' => 7.2906,
                'longitude' => 80.6337,
                'address' => 'Kandy City Center, Sri Lanka',
                'best_time_to_visit' => 'Early morning or sunset for best light',
                'duration' => '1 hour (walking circuit)',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Arthur's Seat Viewpoint
        $arthursSeat = Attraction::where('slug', 'arthurs-seat-viewpoint')->first();
        if ($arthursSeat) {
            $arthursSeat->update([
                'images' => [
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                    'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?w=800',
                ],
                'tags' => ['Viewpoint', 'Knuckles Range', 'Photography', 'Sunrise', 'Tea Estates'],
                'latitude' => 7.3542,
                'longitude' => 80.7228,
                'address' => 'Dolosbage, Kandy, Sri Lanka',
                'best_time_to_visit' => 'Early morning (5:30-7:00 AM) for sunrise',
                'duration' => '30 minutes',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Hanthana Mountain
        $hanthana = Attraction::where('slug', 'hanthana-mountain')->first();
        if ($hanthana) {
            $hanthana->update([
                'images' => [
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                    'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?w=800',
                    'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800',
                ],
                'tags' => ['Hiking', 'Mountain Range', 'Seven Peaks', 'Adventure', 'Tea Plantations', 'Trekking'],
                'latitude' => 7.2547,
                'longitude' => 80.5937,
                'address' => 'Hanthana, Kandy, Sri Lanka',
                'phone' => '+94 77 123 4567',
                'best_time_to_visit' => 'Early morning (5:00-7:00 AM) or late afternoon (4:00-6:00 PM)',
                'duration' => '3-5 hours (full hike)',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Ambuluwawa Tower
        $ambuluwawa = Attraction::where('slug', 'ambuluwawa-tower')->first();
        if ($ambuluwawa) {
            $ambuluwawa->update([
                'images' => [
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                    'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?w=800',
                    'https://images.unsplash.com/photo-1605649487212-47fbe9e30950?w=800',
                ],
                'tags' => ['Spiral Tower', 'Multi-Religious', '360° Views', 'Unique Architecture', 'Must Visit'],
                'latitude' => 7.2742,
                'longitude' => 80.5453,
                'address' => 'Gampola, Kandy, Sri Lanka',
                'phone' => '+94 81 235 2222',
                'best_time_to_visit' => 'Clear weather days for best visibility',
                'duration' => '1-2 hours',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Ramboda Falls
        $ramboda = Attraction::where('slug', 'ramboda-falls')->first();
        if ($ramboda) {
            $ramboda->update([
                'images' => [
                    'https://images.unsplash.com/photo-1580777361964-27e9cdd2f838?w=800',
                    'https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?w=800',
                    'https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=800',
                ],
                'tags' => ['Waterfall', '109m Height', 'Roadside Attraction', 'Photography', 'Natural Beauty'],
                'latitude' => 7.1667,
                'longitude' => 80.6167,
                'address' => 'Ramboda, Nuwara Eliya Road, Sri Lanka',
                'phone' => '+94 52 222 7890',
                'best_time_to_visit' => 'Monsoon season (May-September) for maximum water flow',
                'duration' => '30 minutes',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Hunas Falls
        $hunas = Attraction::where('slug', 'hunas-falls')->first();
        if ($hunas) {
            $hunas->update([
                'images' => [
                    'https://images.unsplash.com/photo-1580777361964-27e9cdd2f838?w=800',
                    'https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=800',
                ],
                'tags' => ['Waterfall', 'Swimming', 'Natural Pool', 'Secluded', 'Adventure'],
                'latitude' => 7.4167,
                'longitude' => 80.6833,
                'address' => 'Elkaduwa, Kandy, Sri Lanka',
                'best_time_to_visit' => 'Dry season (January-March) for safe swimming',
                'duration' => '1-2 hours',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Laxapana Falls
        $laxapana = Attraction::where('slug', 'laxapana-falls')->first();
        if ($laxapana) {
            $laxapana->update([
                'images' => [
                    'https://images.unsplash.com/photo-1580777361964-27e9cdd2f838?w=800',
                    'https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?w=800',
                ],
                'tags' => ['Waterfall', 'Wide Cascade', '129m Height', 'Spectacular', 'Tea Country'],
                'latitude' => 6.8833,
                'longitude' => 80.5167,
                'address' => 'Maskeliya, Near Kandy, Sri Lanka',
                'best_time_to_visit' => 'Monsoon season for best water flow',
                'duration' => '1 hour',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Pinnawala Elephant Orphanage
        $pinnawala = Attraction::where('slug', 'pinnawala-elephant-orphanage')->first();
        if ($pinnawala) {
            $pinnawala->update([
                'images' => [
                    'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800',
                    'https://images.unsplash.com/photo-1551244072-5d12893278ab?w=800',
                    'https://images.unsplash.com/photo-1601214804991-4e5e451fb9e0?w=800',
                ],
                'tags' => ['Elephants', 'Orphanage', 'River Bathing', 'Family Friendly', 'Wildlife', 'Famous'],
                'latitude' => 7.3000,
                'longitude' => 80.3833,
                'address' => 'Pinnawala, Rambukkana, Sri Lanka',
                'phone' => '+94 35 226 5214',
                'email' => 'pinnawala@wildlife.gov.lk',
                'website' => 'http://www.dwc.gov.lk',
                'best_time_to_visit' => 'Bathing times: 10:00 AM and 2:00 PM',
                'duration' => '2-3 hours',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Millennium Elephant Foundation
        $millennium = Attraction::where('slug', 'millennium-elephant-foundation')->first();
        if ($millennium) {
            $millennium->update([
                'images' => [
                    'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800',
                    'https://images.unsplash.com/photo-1551244072-5d12893278ab?w=800',
                ],
                'tags' => ['Elephant Sanctuary', 'Conservation', 'Ethical Tourism', 'Interactive', 'Rescue Center'],
                'latitude' => 7.2500,
                'longitude' => 80.3500,
                'address' => 'Kegalle, Near Kandy, Sri Lanka',
                'phone' => '+94 35 567 3388',
                'email' => 'info@elephantfoundation.lk',
                'website' => 'http://www.millenniumelephantfoundation.com',
                'best_time_to_visit' => 'Morning (8:00-10:00 AM) for feeding time',
                'duration' => '2-3 hours',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Knuckles Mountain Range
        $knuckles = Attraction::where('slug', 'knuckles-mountain-range')->first();
        if ($knuckles) {
            $knuckles->update([
                'images' => [
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                    'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?w=800',
                    'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800',
                    'https://images.unsplash.com/photo-1551632811-561732d1e306?w=800',
                ],
                'tags' => ['UNESCO Site', 'Trekking', 'Biodiversity', 'Camping', 'Adventure', 'Must Visit'],
                'latitude' => 7.4500,
                'longitude' => 80.7833,
                'address' => 'Matale-Kandy Border, Sri Lanka',
                'phone' => '+94 77 234 5678',
                'website' => 'http://www.knucklesrange.com',
                'best_time_to_visit' => 'January-March (dry season)',
                'duration' => 'Full day or multi-day trek',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Victoria Sanctuary
        $victoria = Attraction::where('slug', 'victoria-sanctuary')->first();
        if ($victoria) {
            $victoria->update([
                'images' => [
                    'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800',
                    'https://images.unsplash.com/photo-1535320903710-d993d3d77d29?w=800',
                ],
                'tags' => ['Wildlife Sanctuary', 'Reservoir', 'Elephants', 'Leopards', 'Bird Watching'],
                'latitude' => 7.2333,
                'longitude' => 80.8833,
                'address' => 'Teldeniya, Kandy, Sri Lanka',
                'phone' => '+94 81 247 8901',
                'best_time_to_visit' => 'Early morning (6:00-8:00 AM) for wildlife sightings',
                'duration' => '3-4 hours',
                'languages' => 'Sinhala, English',
            ]);
        }

        // Update Kandy Cultural Dance Show
        $culturalDance = Attraction::where('slug', 'kandy-cultural-dance')->first();
        if ($culturalDance) {
            $culturalDance->update([
                'images' => [
                    'https://images.unsplash.com/photo-1609137144813-7d9921338f24?w=800',
                    'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800',
                ],
                'tags' => ['Cultural Performance', 'Traditional Dance', 'Fire Walking', 'Entertainment', 'Must See'],
                'latitude' => 7.2906,
                'longitude' => 80.6337,
                'address' => 'Kandy Cultural Center, Kandy Lake Road, Sri Lanka',
                'phone' => '+94 81 222 4567',
                'best_time_to_visit' => 'Evening shows (5:00 PM or 6:00 PM)',
                'duration' => '1 hour',
                'languages' => 'Performances with English commentary',
            ]);
        }

        // Update Ceylon Tea Museum
        $teaMuseum = Attraction::where('slug', 'ceylon-tea-museum')->first();
        if ($teaMuseum) {
            $teaMuseum->update([
                'images' => [
                    'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=800',
                    'https://images.unsplash.com/photo-1597318159d98-67608fa042e8?w=800',
                ],
                'tags' => ['Tea Museum', 'Ceylon Tea', 'Tasting', 'History', 'Educational'],
                'latitude' => 7.3167,
                'longitude' => 80.6333,
                'address' => 'Hantane, Kandy, Sri Lanka',
                'phone' => '+94 81 238 1000',
                'email' => 'ceylonteamuseum@srilankatea.com',
                'website' => 'http://www.ceylonteamuseum.com',
                'best_time_to_visit' => 'Morning (9:00-11:00 AM)',
                'duration' => '1-2 hours',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Kandy National Museum
        $nationalMuseum = Attraction::where('slug', 'kandy-national-museum')->first();
        if ($nationalMuseum) {
            $nationalMuseum->update([
                'images' => [
                    'https://images.unsplash.com/photo-1599643477877-530eb83abc8e?w=800',
                    'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800',
                ],
                'tags' => ['Museum', 'Kandyan Kingdom', 'Artifacts', 'History', 'Royal Regalia'],
                'latitude' => 7.2931,
                'longitude' => 80.6350,
                'address' => 'Raja Veediya, Kandy, Sri Lanka',
                'phone' => '+94 81 222 4578',
                'best_time_to_visit' => 'Morning (9:00-11:00 AM)',
                'duration' => '1-1.5 hours',
                'languages' => 'Sinhala, Tamil, English',
            ]);
        }

        // Update Geragama Tea Factory
        $geragama = Attraction::where('slug', 'geragama-tea-factory')->first();
        if ($geragama) {
            $geragama->update([
                'images' => [
                    'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=800',
                    'https://images.unsplash.com/photo-1597318159d98-67608fa042e8?w=800',
                ],
                'tags' => ['Tea Factory', 'Working Factory', 'Tea Production', 'Tasting', 'Educational'],
                'latitude' => 7.2500,
                'longitude' => 80.8500,
                'address' => 'Teldeniya, Kandy, Sri Lanka',
                'phone' => '+94 81 247 5678',
                'best_time_to_visit' => 'Weekdays (8:00 AM - 4:00 PM) when factory is operating',
                'duration' => '1 hour',
                'languages' => 'Sinhala, English',
            ]);
        }
    }
}
