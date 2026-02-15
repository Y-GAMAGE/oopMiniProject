{{-- filepath: d:\Programming\oop\MiniProject\oopMiniProject\resources\views\admin\dashboard.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="admin-dashboard">
    {{-- Statistics Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #667eea;">
                <span>📊</span>
            </div>
            <div class="stat-content">
                <h3>Total Attractions</h3>
                <div class="stat-value">{{ number_format($stats['total_attractions']) }}</div>
                <div class="stat-growth positive">
                    <span>↑</span> {{ $stats['growth'] }}
                </div>
            </div>
            <div class="stat-chart">
                <svg viewBox="0 0 100 30" class="sparkline">
                    <polyline points="0,20 20,18 40,15 60,12 80,10 100,8" fill="none" stroke="#667eea" stroke-width="2"/>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #48bb78;">
                <span>👥</span>
            </div>
            <div class="stat-content">
                <h3>Active Users</h3>
                <div class="stat-value">{{ number_format($stats['active_users']) }}</div>
                <div class="stat-growth positive">
                    <span>↑</span> {{ $stats['growth_percent'] }}
                </div>
            </div>
            <div class="stat-chart">
                <svg viewBox="0 0 100 30" class="sparkline">
                    <polyline points="0,25 20,22 40,20 60,15 80,12 100,8" fill="none" stroke="#48bb78" stroke-width="2"/>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #ed8936;">
                <span>🆕</span>
            </div>
            <div class="stat-content">
                <h3>New Listings</h3>
                <div class="stat-value">{{ $stats['new_listings'] }}</div>
                <div class="stat-pending">
                    {{ $stats['pending'] }}
                </div>
            </div>
            <div class="stat-chart">
                <svg viewBox="0 0 100 30" class="sparkline">
                    <polyline points="0,28 20,25 40,23 60,20 80,18 100,15" fill="none" stroke="#ed8936" stroke-width="2"/>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #f6ad55;">
                <span>⭐</span>
            </div>
            <div class="stat-content">
                <h3>Average Rating</h3>
                <div class="stat-value">{{ $stats['average_rating'] }} <span class="star">★</span></div>
                <div class="stat-subtext">
                    From {{ number_format($stats['reviews_count']) }} reviews
                </div>
            </div>
            <div class="stat-chart">
                <svg viewBox="0 0 100 30" class="sparkline">
                    <polyline points="0,15 20,14 40,13 60,13 80,14 100,13" fill="none" stroke="#f6ad55" stroke-width="2"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="action-buttons">
        <a href="{{ route('admin.countries.create') }}" class="action-btn btn-primary">
            <span class="icon">🌍</span>
            <span class="text">Add New Country</span>
        </a>
        <a href="{{ route('admin.attractions.create') }}" class="action-btn btn-success">
            <span class="icon">📍</span>
            <span class="text">Add New Attraction</span>
        </a>
        <a href="{{ route('admin.report') }}" class="action-btn btn-info">
            <span class="icon">📊</span>
            <span class="text">Generate Report</span>
        </a>
    </div>

    {{-- Charts Row --}}
    <div class="charts-row">
        <div class="chart-card">
            <div class="chart-header">
                <h3>Visitor Statistics</h3>
                <select class="chart-period">
                    <option>Last 30 days</option>
                    <option>Last 7 days</option>
                    <option>Last 90 days</option>
                </select>
            </div>
            <canvas id="visitorChart"></canvas>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <h3>User Growth</h3>
            </div>
            <canvas id="userGrowthChart"></canvas>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Recent Activity --}}
        <div class="dashboard-section">
            <div class="section-header">
                <h3>Recent Activity</h3>
                <a href="#" class="view-all">View All Activity →</a>
            </div>
            <div class="activity-list">
                @foreach($recentActivity as $activity)
                <div class="activity-item">
                    <div class="activity-icon">{{ $activity['icon'] }}</div>
                    <div class="activity-content">
                        <p>{{ $activity['text'] }}</p>
                        <span class="activity-time">{{ $activity['time'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Most Viewed Attractions --}}
        <div class="dashboard-section">
            <div class="section-header">
                <h3>Most Viewed Attractions</h3>
            </div>
            <div class="list-items">
                @foreach($mostViewed as $attraction)
                <div class="list-item">
                    <span class="item-name">{{ $attraction->name }}</span>
                    <span class="item-badge">{{ number_format($attraction->views_count ?? rand(500, 2000)) }} views</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Highest Rated Hotels --}}
        <div class="dashboard-section">
            <div class="section-header">
                <h3>Highest Rated Hotels</h3>
            </div>
            <div class="list-items">
                @foreach($highestRated as $hotel)
                <div class="list-item">
                    <span class="item-name">{{ $hotel->name }}</span>
                    <span class="item-rating">{{ $hotel->rating }} ⭐</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Most Reviewed Restaurants --}}
        <div class="dashboard-section">
            <div class="section-header">
                <h3>Most Reviewed Restaurants</h3>
            </div>
            <div class="list-items">
                @foreach($mostReviewed as $restaurant)
                <div class="list-item">
                    <span class="item-name">{{ $restaurant->name }}</span>
                    <span class="item-badge green">{{ $restaurant->reviews_count }} reviews</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Visitor Statistics Chart
const visitorCtx = document.getElementById('visitorChart').getContext('2d');
new Chart(visitorCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($visitorStats['days']) !!},
        datasets: [{
            label: 'Visitors',
            data: {!! json_encode($visitorStats['values']) !!},
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        }
    }
});

// User Growth Chart
const userCtx = document.getElementById('userGrowthChart').getContext('2d');
new Chart(userCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($userGrowth['months']) !!},
        datasets: [{
            label: 'Users',
            data: {!! json_encode($userGrowth['values']) !!},
            borderColor: '#48bb78',
            backgroundColor: 'rgba(72, 187, 120, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>
@endsection
