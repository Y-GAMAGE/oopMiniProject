@extends('layouts.app')

@section('title', 'Districts in ' . $country->name . ' - TravelEase')

@section('styles')
<style>
    /* Hero Section with Country Background */
    .districts-hero {
        position: relative;
        height: 400px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white;
    }

    .districts-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7));
    }

    .districts-hero-content {
        position: relative;
        z-index: 1;
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 0 32px;
    }

    .breadcrumb {
        display: flex;
        gap: 8px;
        font-size: 14px;
        margin-bottom: 20px;
        color: rgba(255, 255, 255, 0.8);
    }

    .breadcrumb a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
    }

    .breadcrumb a:hover {
        color: white;
    }

    .country-flag {
        width: 80px;
        height: 60px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        margin-bottom: 20px;
        object-fit: cover;
    }

    .districts-hero h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 12px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .districts-hero p {
        font-size: 18px;
        opacity: 0.95;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    /* About Section */
    .about-section {
        max-width: 1440px;
        margin: -60px auto 60px;
        padding: 0 32px;
        position: relative;
    }

    .about-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 40px;
    }

    .about-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .about-text {
        font-size: 16px;
        line-height: 1.8;
        color: #4b5563;
    }

    /* Info Cards */
    .info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 60px;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .info-icon {
        font-size: 32px;
        margin-bottom: 12px;
    }

    .info-value {
        font-size: 24px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .info-label {
        font-size: 14px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Main Content */
    .districts-content {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 32px 80px;
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 32px;
    }

    /* Sidebar */
    .sidebar {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .sidebar-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .filter-section {
        margin-bottom: 24px;
        padding-bottom: 24px;
        border-bottom: 1px solid #e5e7eb;
    }

    .filter-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .filter-label {
        font-size: 14px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 12px;
        display: block;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 12px 16px 12px 40px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .search-box input:focus {
        outline: none;
        border-color: #06b6d4;
    }

    .search-box svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #9ca3af;
    }

    .sort-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
    }

    .sort-select:focus {
        outline: none;
        border-color: #06b6d4;
    }

    .reset-btn {
        width: 100%;
        padding: 12px;
        background: #f3f4f6;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #1e3a8a;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .reset-btn:hover {
        background: #e5e7eb;
    }

    /* Main Districts Area */
    .districts-main {
        min-height: 500px;
    }

    .districts-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .results-count {
        font-size: 18px;
        font-weight: 600;
        color: #1e3a8a;
    }

    .results-count span {
        color: #06b6d4;
    }

    .view-toggle {
        display: flex;
        gap: 8px;
        background: #f3f4f6;
        padding: 4px;
        border-radius: 8px;
    }

    .view-btn {
        padding: 8px 16px;
        border: none;
        background: transparent;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 600;
        color: #6b7280;
    }

    .view-btn.active {
        background: white;
        color: #1e3a8a;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Districts Grid */
    .districts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    /* District Card */
    .district-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
    }

    .district-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }

    .district-image {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .district-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .district-card:hover .district-image img {
        transform: scale(1.1);
    }

    .district-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 6px 12px;
        background: rgba(6, 182, 212, 0.95);
        color: white;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .district-content {
        padding: 20px;
    }

    .district-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .district-region {
        font-size: 13px;
        color: #06b6d4;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .district-stats {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .district-description {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .view-categories-btn {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .view-categories-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
    }

    /* List View */
    .districts-list {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .district-card-list {
        display: flex;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .district-card-list:hover {
        transform: translateX(8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .district-image-list {
        width: 250px;
        flex-shrink: 0;
    }

    .district-image-list img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .district-content-list {
        flex: 1;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 40px;
    }

    .pagination a,
    .pagination span {
        padding: 10px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        text-decoration: none;
        color: #1e3a8a;
        font-weight: 600;
        transition: all 0.3s;
    }

    .pagination a:hover {
        background: #06b6d4;
        color: white;
        border-color: #06b6d4;
    }

    .pagination .active {
        background: #1e3a8a;
        color: white;
        border-color: #1e3a8a;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .districts-content {
            grid-template-columns: 1fr;
        }

        .sidebar {
            position: static;
        }

        .info-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .districts-hero h1 {
            font-size: 32px;
        }

        .districts-grid {
            grid-template-columns: 1fr;
        }

        .district-card-list {
            flex-direction: column;
        }

        .district-image-list {
            width: 100%;
            height: 200px;
        }

        .info-cards {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="districts-hero" style="background-image: url('{{ $country->image_url }}');">
    <div class="districts-hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>›</span>
            <a href="{{ route('countries.index') }}">Countries</a>
            <span>›</span>
            <a href="{{ route('countries.show', $country->slug) }}">{{ $country->name }}</a>
            <span>›</span>
            <span>Districts</span>
        </div>

        <img src="{{ $country->image_url }}" alt="{{ $country->name }} Flag" class="country-flag">

        <h1>{{ $country->districts_count }} Districts in {{ $country->name }}</h1>
        <p>Explore all regions and cantons across the country</p>
    </div>
</div>

<!-- About Section -->
<div class="about-section">
    <div class="about-card">
        <h2 class="about-title">About {{ $country->name }}</h2>
        <p class="about-text">
            {{ $country->description ?? 'Discover the diverse districts and regions of ' . $country->name . '. Each district offers unique attractions, cultural experiences, and natural beauty waiting to be explored.' }}
        </p>
    </div>



<!-- Main Content -->
<div class="districts-content">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h3 class="sidebar-title">Filter Districts</h3>

        <form action="{{ route('countries.districts.index', $country->slug) }}" method="GET" id="filterForm">
            <!-- Search -->
            <div class="filter-section">
                <label class="filter-label">Search</label>
                <div class="search-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        placeholder="Search districts in {{ $country->name }}..."
                        value="{{ request('search') }}"
                        onchange="document.getElementById('filterForm').submit()"
                    >
                </div>
            </div>

            <!-- Sort By -->
            <div class="filter-section">
                <label class="filter-label">Sort By</label>
                <select name="sort" class="sort-select" onchange="document.getElementById('filterForm').submit()">
                    <option value="alphabetical" {{ $sortBy == 'alphabetical' ? 'selected' : '' }}>Alphabetical</option>
                    <option value="most_attractions" {{ $sortBy == 'most_attractions' ? 'selected' : '' }}>Most Attractions</option>
                    <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Newest</option>
                </select>
            </div>

            <!-- Reset Filters -->
            <a href="{{ route('countries.districts.index', $country->slug) }}" class="reset-btn">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                </svg>
                Reset Filters
            </a>
        </form>
    </aside>

    <!-- Main Districts -->
    <main class="districts-main">
        <!-- Header -->
        <div class="districts-header">
            <div class="results-count">
                <span>{{ $districts->total() }}</span> Districts Found
            </div>
            <div class="view-toggle">
                <a href="{{ route('countries.districts.index', array_merge(['country' => $country->slug], request()->query(), ['view' => 'grid'])) }}"
                   class="view-btn {{ $viewMode == 'grid' ? 'active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                    </svg>
                    Grid
                </a>
                <a href="{{ route('countries.districts.index', array_merge(['country' => $country->slug], request()->query(), ['view' => 'list'])) }}"
                   class="view-btn {{ $viewMode == 'list' ? 'active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    List
                </a>
            </div>
        </div>

        @if($viewMode == 'grid')
            <!-- Grid View -->
            <div class="districts-grid">
                @foreach($districts as $district)
                <div class="district-card">
                    <div class="district-image">
                        <img src="{{ $district->image_url ?? 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=600&h=400&fit=crop' }}"
                             alt="{{ $district->name }}"
                             loading="lazy">
                        <span class="district-badge">{{ $district->region ?? 'Canton' }}</span>
                    </div>
                    <div class="district-content">
                        <h3 class="district-name">{{ $district->name }}</h3>
                        @if($district->region)
                        <div class="district-region">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                            </svg>
                            {{ $district->region }}
                        </div>
                        @endif
                        <div class="district-stats">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            {{ $district->attractions_count }} Attractions
                        </div>
                        <p class="district-description">
                            {{ $district->description ?? 'Discover the unique attractions and experiences in ' . $district->name . '.' }}
                        </p>
                        <a href="{{ route('countries.districts.show', [$country->slug, $district->slug]) }}" class="view-categories-btn">
                            View Categories
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- List View -->
            <div class="districts-list">
                @foreach($districts as $district)
                <div class="district-card-list">
                    <div class="district-image-list">
                        <img src="{{ $district->image_url ?? 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=600&h=400&fit=crop' }}"
                             alt="{{ $district->name }}"
                             loading="lazy">
                    </div>
                    <div class="district-content-list">
                        <div>
                            <h3 class="district-name">{{ $district->name }}</h3>
                            @if($district->region)
                            <div class="district-region">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                </svg>
                                {{ $district->region }}
                            </div>
                            @endif
                            <div class="district-stats">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                {{ $district->attractions_count }} Attractions
                            </div>
                            <p class="district-description">
                                {{ $district->description ?? 'Discover the unique attractions and experiences in ' . $district->name . '.' }}
                            </p>
                        </div>
                        <a href="{{ route('countries.districts.categories.index', [$country->slug, $district->slug]) }}" class="view-btn">
                            View Categories
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <!-- Pagination -->
        <div class="pagination">
            {{ $districts->links() }}
        </div>
    </main>
</div>
@endsection
