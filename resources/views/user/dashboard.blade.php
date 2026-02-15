{{-- filepath: d:\Programming\oop\MiniProject\oopMiniProject\resources\views\user\dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - TravelEase</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }

        /* Top Navigation Bar */
        .top-nav {
            background: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .search-bar {
            flex: 0 0 500px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #667eea;
        }

        .nav-right {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
            font-size: 24px;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-dropdown {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #667eea;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
            min-width: 150px;
            overflow: hidden;
        }

        .user-dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: #333;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background 0.3s;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f5f7fa;
        }

        /* Main Dashboard Layout */
        .dashboard-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 30px;
            padding: 30px 40px;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Left Sidebar */
        .left-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .user-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .user-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #667eea;
        }

        .user-card h3 {
            color: #333;
            margin-bottom: 5px;
            font-size: 18px;
        }

        .user-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .user-card .member-since {
            color: #999;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .edit-profile-btn {
            display: inline-block;
            padding: 8px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 14px;
            transition: background 0.3s;
        }

        .edit-profile-btn:hover {
            background: #5568d3;
        }

        .nav-menu {
            background: white;
            border-radius: 12px;
            padding: 10px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .nav-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 25px;
            text-decoration: none;
            color: #666;
            transition: all 0.3s;
            font-size: 15px;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background: #f5f7fa;
            color: #667eea;
        }

        .nav-menu a .icon {
            font-size: 20px;
        }

        .plan-trip-btn {
            display: block;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: transform 0.3s;
        }

        .plan-trip-btn:hover {
            transform: translateY(-2px);
        }

        /* Right Content */
        .right-content {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        }

        .welcome-card h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .welcome-card p {
            font-size: 16px;
            opacity: 0.9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-icon {
            font-size: 40px;
            opacity: 0.8;
        }

        .stat-content h3 {
            color: #999;
            font-size: 13px;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .stat-content .number {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h3 {
            font-size: 20px;
            color: #333;
        }

        .view-all-link {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .view-all-link:hover {
            text-decoration: underline;
        }

        /* Trips Section */
        .trips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .trip-card {
            border: 2px solid #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
        }

        .trip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .trip-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .trip-card-content {
            padding: 20px;
        }

        .trip-card-content h4 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #333;
        }

        .trip-date {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .trip-details {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #999;
        }

        .add-trip-card {
            border: 2px dashed #ccc;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: #666;
        }

        .add-trip-card:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .add-trip-card .plus-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        /* Saved Places */
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab {
            padding: 8px 20px;
            border: none;
            background: #f5f7fa;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .tab.active {
            background: #667eea;
            color: white;
        }

        .saved-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .saved-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
        }

        .saved-item:hover {
            border-color: #667eea;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
        }

        .saved-item img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .saved-item-content {
            flex: 1;
        }

        .saved-item-content h4 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .saved-item-meta {
            font-size: 13px;
            color: #999;
            margin-bottom: 5px;
        }

        .saved-item-rating {
            color: #ffa500;
            font-size: 14px;
        }

        /* Activity Section */
        .two-column-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            gap: 15px;
            align-items: center;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .activity-icon {
            font-size: 32px;
        }

        .activity-content p {
            margin: 0;
            color: #333;
            font-size: 14px;
        }

        .activity-time {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        /* Recommendations */
        .recommendations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .recommendation-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
        }

        .recommendation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .recommendation-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .recommendation-content {
            padding: 15px;
        }

        .recommendation-content h4 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .recommendation-content p {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
        }

        .recommendation-rating {
            color: #ffa500;
            font-size: 14px;
        }

        @media (max-width: 1200px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .top-nav {
                padding: 15px 20px;
                flex-wrap: wrap;
            }

            .search-bar {
                flex: 1 1 100%;
                order: 3;
                margin-top: 15px;
            }

            .two-column-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <div class="top-nav">
        <a href="{{ route('home') }}" class="logo">TravelEase</a>

        <div class="search-bar">
            <input type="text" placeholder="Search destinations, hotels, attractions...">
        </div>

        <div class="nav-right">
            <div class="notification-icon">
                🔔
                <span class="notification-badge">3</span>
            </div>

            <div class="user-dropdown">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=667eea&color=fff" alt="User Avatar" class="user-avatar">
                <div class="dropdown-menu">
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    <a href="{{ route('user.profile') }}">My Profile</a>
                    <a href="{{ route('user.settings') }}">Settings</a>
                    <hr style="margin: 5px 0; border: none; border-top: 1px solid #e0e0e0;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard -->
    <div class="dashboard-container">
        <!-- Left Sidebar -->
        <div class="left-sidebar">
            {{-- <div class="user-card">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200&background=667eea&color=fff" alt="{{ $user->name }}">
                <h3>{{ $user->name }}</h3>
                <p>{{ $user->email }}</p>
                <p class="member-since">Member since {{ $user->created_at->format('M Y') }}</p>
                <a href="{{ route('user.profile') }}" class="edit-profile-btn">Edit Profile</a>
            </div> --}}

            <div class="nav-menu">
                <a href="{{ route('user.dashboard') }}" class="active">
                    <span class="icon">🏠</span>
                    Dashboard
                </a>
                <a href="{{ route('user.trips') }}">
                    <span class="icon">🧳</span>
                    My Trips
                </a>
                <a href="{{ route('user.saved') }}">
                    <span class="icon">❤️</span>
                    Saved Places
                </a>
                <a href="{{ route('user.reviews') }}">
                    <span class="icon">⭐</span>
                    My Reviews
                </a>
                <a href="{{ route('user.settings') }}">
                    <span class="icon">⚙️</span>
                    Settings
                </a>
            </div>

            <a href="{{ route('trips.create') }}" class="plan-trip-btn">
                ✈️ Plan New Trip
            </a>
        </div>

        <!-- Right Content -->
        <div class="right-content">
            <!-- Welcome Card -->
            <div class="welcome-card">
                <h2>Welcome back, {{ $user->name }}! 👋</h2>
                <p>{{ now()->format('l, F j, Y') }} • Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}! Ready to plan your next adventure?</p>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">🗺️</div>
                    <div class="stat-content">
                        <h3>Trips Planned</h3>
                        <div class="number">{{ $stats['total_trips'] }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">❤️</div>
                    <div class="stat-content">
                        <h3>Places Saved</h3>
                        <div class="number">{{ $stats['saved_places'] }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">⭐</div>
                    <div class="stat-content">
                        <h3>Reviews Written</h3>
                        <div class="number">{{ $stats['reviews_count'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Your Trips Section -->
            <div class="section">
                <div class="section-header">
                    <h3>Your Trips</h3>
                    <a href="{{ route('user.trips') }}" class="view-all-link">View All →</a>
                </div>
                <div class="trips-grid">
                    @forelse($upcomingTrips as $trip)
                        <div class="trip-card">
                            <img src="{{ $trip->image_url ?? 'https://via.placeholder.com/400x200?text=Trip' }}" alt="{{ $trip->destination }}">
                            <div class="trip-card-content">
                                <h4>{{ $trip->destination }}</h4>
                                <p class="trip-date">{{ $trip->start_date->format('M d') }} - {{ $trip->end_date->format('M d, Y') }}</p>
                                <div class="trip-details">
                                    <span>📍 {{ $trip->attractions_count ?? 0 }} attractions</span>
                                    <span>🏨 {{ $trip->hotels_count ?? 0 }} hotels</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="add-trip-card">
                            <div class="plus-icon">+</div>
                            <h4>Plan a New Trip</h4>
                            <p>Start planning your next adventure</p>
                        </div>
                    @endforelse

                    @if($upcomingTrips->count() > 0)
                        <a href="{{ route('trips.create') }}" class="add-trip-card">
                            <div class="plus-icon">+</div>
                            <h4>Plan a New Trip</h4>
                            <p>Start planning your next adventure</p>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Saved Places & Recent Activity -->
            <div class="two-column-grid">
                <!-- Saved Places -->
                <div class="section">
                    <div class="section-header">
                        <h3>Your Saved Places</h3>
                        <a href="{{ route('user.saved') }}" class="view-all-link">View All →</a>
                    </div>
                    <div class="tabs">
            <button class="tab active" onclick="window.location='{{ route('user.saved') }}'">All</button>
            <button class="tab" onclick="window.location='{{ route('user.saved', ['type' => 'attraction']) }}'">Attractions</button>
            <button class="tab" onclick="window.location='{{ route('user.saved', ['type' => 'accommodation']) }}'">Hotels</button>
            <button class="tab" onclick="window.location='{{ route('user.saved', ['type' => 'restaurant']) }}'">Restaurants</button>
        </div>
                   <div class="saved-list">
            @forelse($savedPlaces as $saved)
                @php
                    $place = $saved->saveable;
                @endphp
                @if($place)
                    <a href="{{
                        class_basename($saved->saveable_type) === 'Attraction'
                            ? route('attractions.show', [
                                $place->district->country->slug,
                                $place->district->slug,
                                $place->category->slug,
                                $place->slug
                            ])
                            : '#'
                    }}" class="saved-item">
                        <img src="{{ $place->image_url ?? 'https://via.placeholder.com/80' }}" alt="{{ $place->name }}">
                        <div class="saved-item-content">
                            <h4>{{ $place->name }}</h4>
                            <p class="saved-item-meta">
                                <span class="type-badge" style="display: inline-block; padding: 2px 8px; background: #e0e7ff; color: #1e3a8a; border-radius: 10px; font-size: 11px; margin-right: 8px;">
                                    {{ class_basename($saved->saveable_type) }}
                                </span>
                                {{ $place->location ?? $place->address ?? 'Location N/A' }}
                            </p>
                            <span class="saved-item-rating">⭐ {{ number_format($place->rating ?? 0, 1) }}</span>
                        </div>
                    </a>
                @endif
            @empty
                <p style="text-align: center; color: #999; padding: 20px;">No saved places yet. Start exploring!</p>
            @endforelse
        </div>
    </div>


                <!-- Recent Activity -->
                <div class="section">
        <div class="section-header">
            <h3>Recent Activity</h3>
        </div>
        <div class="activity-list">
            @forelse($recentActivity as $activity)
                <div class="activity-item">
                    <div class="activity-icon">{{ $activity['icon'] }}</div>
                    <div class="activity-content">
                        <p>{{ $activity['text'] }}</p>
                        <p class="activity-time">{{ $activity['time'] }}</p>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #999; padding: 20px;">No recent activity</p>
            @endforelse
        </div>
    </div>
            </div>

            <!-- Places You Might Like -->
            <div class="section">
                <div class="section-header">
                    <h3>Places You Might Like</h3>
                    <a href="{{ route('countries.index') }}" class="view-all-link">Explore More →</a>
                </div>
                <div class="recommendations-grid">
                    @foreach($recommendedPlaces as $place)
                        <a href="{{ route('attractions.show', [
                'country' => $place->district->country->slug,
                'district' => $place->district->slug,
                'category' => $place->category->slug,
                'attraction' => $place->slug
            ]) }}" class="recommendation-card">
                <img src="{{ $place->image_url ?? 'https://via.placeholder.com/400x300?text=Attraction' }}" alt="{{ $place->name }}">
                <div class="recommendation-content">
                    <h4>{{ $place->name }}</h4>
                    <p>{{ $place->location }}</p>
                    <span class="recommendation-rating">⭐ {{ number_format($place->rating, 1) }}</span>
                </div>
            </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
