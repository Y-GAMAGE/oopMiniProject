@extends('layouts.app')

@section('title', $category->name . ' in ' . $district->name . ' - TravelEase')

@section('styles')
<style>
    /* Hero Section */
    .category-hero {
        position: relative;
        height: 300px;
        background: linear-gradient(135deg, {{ $category->color }}dd 0%, {{ $category->color }}99 100%);
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white;
    }

    .category-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
    }

    .category-hero-content {
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
        color: rgba(255, 255, 255, 0.9);
    }

    .breadcrumb a {
        color: white;
        text-decoration: none;
        opacity: 0.9;
    }

    .breadcrumb a:hover {
        opacity: 1;
    }

    .category-hero-title {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 12px;
    }

    .category-icon-large {
        font-size: 72px;
        filter: drop-shadow(2px 2px 8px rgba(0, 0, 0, 0.3));
    }

    .category-hero h1 {
        font-size: 48px;
        font-weight: 700;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    }

    .category-hero-subtitle {
        font-size: 18px;
        opacity: 0.95;
    }

    /* Main Content */
    .attractions-container {
        max-width: 1440px;
        margin: -40px auto 80px;
        padding: 0 32px;
        position: relative;
        z-index: 2;
    }

    .attractions-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 32px;
        align-items: start;
    }

    /* Sidebar Filters */
    .filters-sidebar {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 100px;
    }

    .filter-section {
        margin-bottom: 28px;
        padding-bottom: 28px;
        border-bottom: 2px solid #f3f4f6;
    }

    .filter-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .filter-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 12px 40px 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .search-box input:focus {
        outline: none;
        border-color: {{ $category->color }};
        box-shadow: 0 0 0 3px {{ $category->color }}22;
    }

    .search-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 18px;
    }

    .rating-filters {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .rating-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: background 0.2s;
    }

    .rating-option:hover {
        background: #f9fafb;
    }

    .rating-option input {
        cursor: pointer;
    }

    .rating-stars {
        color: #f59e0b;
        font-size: 14px;
    }

    .entry-fee-options {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .fee-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: background 0.2s;
    }

    .fee-option:hover {
        background: #f9fafb;
    }

    .facilities-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .facility-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: background 0.2s;
    }

    .facility-option:hover {
        background: #f9fafb;
    }

    .open-now-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        background: #f9fafb;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .open-now-toggle:hover {
        background: #f3f4f6;
    }

    .open-now-toggle input {
        cursor: pointer;
        width: 20px;
        height: 20px;
    }

    .reset-filters-btn {
        width: 100%;
        padding: 12px;
        background: #6b7280;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 20px;
    }

    .reset-filters-btn:hover {
        background: #4b5563;
    }

    /* Main Content Area */
    .attractions-content {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .results-count {
        font-size: 24px;
        font-weight: 700;
        color: #1e3a8a;
    }

    .view-controls {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .sort-select {
        padding: 10px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .sort-select:focus {
        outline: none;
        border-color: {{ $category->color }};
    }

    .view-toggle {
        display: flex;
        gap: 8px;
        background: #f3f4f6;
        padding: 4px;
        border-radius: 10px;
    }

    .view-btn {
        padding: 8px 16px;
        border: none;
        background: transparent;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 18px;
    }

    .view-btn.active {
        background: white;
        color: {{ $category->color }};
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Active Filters */
    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 24px;
    }

    .filter-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        background: {{ $category->color }}22;
        color: {{ $category->color }};
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .filter-tag button {
        background: none;
        border: none;
        color: {{ $category->color }};
        cursor: pointer;
        font-size: 16px;
        padding: 0;
        line-height: 1;
    }

    /* Attractions Grid */
    .attractions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .attractions-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Grid View Card */
    .attraction-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .attraction-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        border-color: {{ $category->color }};
    }

    .attraction-image {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .attraction-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .attraction-card:hover .attraction-image img {
        transform: scale(1.1);
    }

    .attraction-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 6px 12px;
        background: {{ $category->color }};
        color: white;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .attraction-content {
        padding: 20px;
    }

    .attraction-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .attraction-location {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .attraction-description {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .attraction-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 2px solid #f3f4f6;
    }

    .attraction-rating {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #f59e0b;
        font-weight: 600;
    }

    .attraction-price {
        font-size: 14px;
        color: #059669;
        font-weight: 600;
    }

    .attraction-facilities {
        display: flex;
        gap: 8px;
        margin-top: 12px;
        flex-wrap: wrap;
    }

    .facility-icon {
        font-size: 16px;
        padding: 6px;
        background: #f3f4f6;
        border-radius: 6px;
    }

    /* List View Card */
    .attraction-card-list {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 24px;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .attraction-card-list:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        border-color: {{ $category->color }};
    }

    .attraction-card-list .attraction-image {
        height: 100%;
        min-height: 200px;
    }

    .attraction-card-list .attraction-content {
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .load-more-btn {
        padding: 14px 32px;
        background: {{ $category->color }};
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .load-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        filter: brightness(1.1);
    }

    /* Empty State */
    .no-results {
        text-align: center;
        padding: 80px 32px;
        color: #6b7280;
    }

    .no-results-icon {
        font-size: 64px;
        margin-bottom: 16px;
    }

    .no-results h3 {
        font-size: 24px;
        color: #1e3a8a;
        margin-bottom: 12px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .attractions-layout {
            grid-template-columns: 1fr;
        }

        .filters-sidebar {
            position: relative;
            top: 0;
        }
    }

    @media (max-width: 768px) {
        .category-hero {
            height: 250px;
        }

        .category-hero h1 {
            font-size: 32px;
        }

        .category-icon-large {
            font-size: 48px;
        }

        .attractions-grid {
            grid-template-columns: 1fr;
        }

        .attraction-card-list {
            grid-template-columns: 1fr;
        }

        .attraction-card-list .attraction-image {
            height: 200px;
            min-height: 200px;
        }

        .content-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .view-controls {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="category-hero" style="background-image: url('{{ $category->image_url ?? $district->image_url }}');">
    <div class="category-hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>›</span>
            <a href="{{ route('countries.index') }}">Countries</a>
            <span>›</span>
            <a href="{{ route('countries.show', $country->slug) }}">{{ $country->name }}</a>
            <span>›</span>
            <a href="{{ route('countries.districts.categories.index', [$country->slug, $district->slug]) }}">{{ $district->name }}</a>
            <span>›</span>
            <span>{{ $category->name }}</span>
        </div>

        <div class="category-hero-title">
            <div class="category-icon-large">{{ $category->icon }}</div>
            <div>
                <h1>{{ $category->name }}</h1>
                <p class="category-hero-subtitle">{{ $district->name }} District</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="attractions-container">
    <form action="{{ route('countries.districts.categories.attractions', [$country->slug, $district->slug, $category->slug]) }}" method="GET" id="filterForm">
        <div class="attractions-layout">
            <!-- Sidebar Filters -->
            <aside class="filters-sidebar">
                <!-- Search -->
                <div class="filter-section">
                    <div class="filter-title">🔍 Search</div>
                    <div class="search-box">
                        <input type="text" name="search" placeholder="Search attractions..." value="{{ request('search') }}">
                        <span class="search-icon">🔎</span>
                    </div>
                </div>

                <!-- Rating Filter -->
                <div class="filter-section">
                    <div class="filter-title">⭐ Rating</div>
                    <div class="rating-filters">
                        <label class="rating-option">
                            <input type="radio" name="rating" value="4.5" {{ request('rating') == '4.5' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="rating-stars">★★★★★</span>
                            <span>4.5+</span>
                        </label>
                        <label class="rating-option">
                            <input type="radio" name="rating" value="4" {{ request('rating') == '4' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="rating-stars">★★★★☆</span>
                            <span>4.0+</span>
                        </label>
                        <label class="rating-option">
                            <input type="radio" name="rating" value="3" {{ request('rating') == '3' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="rating-stars">★★★☆☆</span>
                            <span>3.0+</span>
                        </label>
                    </div>
                </div>

                <!-- Entry Fee Filter -->
                <div class="filter-section">
                    <div class="filter-title">💰 Entry Fee</div>
                    <div class="entry-fee-options">
                        <label class="fee-option">
                            <input type="radio" name="entry_fee" value="free" {{ request('entry_fee') == 'free' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span>Free Entry</span>
                        </label>
                        <label class="fee-option">
                            <input type="radio" name="entry_fee" value="500" {{ request('entry_fee') == '500' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span>Under Rs. 500</span>
                        </label>
                        <label class="fee-option">
                            <input type="radio" name="entry_fee" value="1000" {{ request('entry_fee') == '1000' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span>Under Rs. 1000</span>
                        </label>
                        <label class="fee-option">
                            <input type="radio" name="entry_fee" value="2000" {{ request('entry_fee') == '2000' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span>Under Rs. 2000</span>
                        </label>
                    </div>
                </div>

                <!-- Facilities Filter -->
                <div class="filter-section">
                    <div class="filter-title">🏢 Facilities</div>
                    <div class="facilities-grid">
                        @foreach($availableFacilities as $facilityKey => $facilityName)
                        <label class="facility-option">
                            <input type="checkbox" name="facilities[]" value="{{ $facilityKey }}"
                                {{ in_array($facilityKey, request('facilities', [])) ? 'checked' : '' }}
                                onchange="this.form.submit()">
                            <span>{{ $facilityName }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Open Now -->
                <div class="filter-section">
                    <div class="filter-title">🕒 Availability</div>
                    <label class="open-now-toggle">
                        <span>Open Now</span>
                        <input type="checkbox" name="open_now" value="1" {{ request('open_now') ? 'checked' : '' }} onchange="this.form.submit()">
                    </label>
                </div>

                <!-- Reset Filters -->
                <button type="button" class="reset-filters-btn" onclick="window.location.href='{{ route('countries.districts.categories.show', [$country->slug, $district->slug, $category->slug]) }}'">
                    Reset Filters
                </button>
            </aside>

            <!-- Main Content -->
            <div class="attractions-content">
                <!-- Header -->
                <div class="content-header">
                    <div class="results-count">
                        {{ $attractions->total() }} {{ Str::plural('Attraction', $attractions->total()) }} Found
                    </div>

                    <div class="view-controls">
                        <select name="sort" class="sort-select" onchange="this.form.submit()">
                            <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>Highest Rated</option>
                            <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>Lowest Rated</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Most Reviewed</option>
                            <option value="entry_fee" {{ request('sort') == 'entry_fee' ? 'selected' : '' }}>Entry Fee (Low-High)</option>
                        </select>

                        <div class="view-toggle">
                            <button type="button" class="view-btn {{ $viewMode == 'grid' ? 'active' : '' }}" onclick="changeView('grid')">
                                ⊞
                            </button>
                            <button type="button" class="view-btn {{ $viewMode == 'list' ? 'active' : '' }}" onclick="changeView('list')">
                                ☰
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Active Filters -->
                @if(request()->hasAny(['search', 'rating', 'entry_fee', 'facilities', 'open_now']))
                <div class="active-filters">
                    @if(request('search'))
                    <div class="filter-tag">
                        Search: "{{ request('search') }}"
                        <button type="button" onclick="removeFilter('search')">×</button>
                    </div>
                    @endif

                    @if(request('rating'))
                    <div class="filter-tag">
                        Rating: {{ request('rating') }}+ ⭐
                        <button type="button" onclick="removeFilter('rating')">×</button>
                    </div>
                    @endif

                    @if(request('entry_fee'))
                    <div class="filter-tag">
                        {{ request('entry_fee') == 'free' ? 'Free Entry' : 'Under Rs. ' . request('entry_fee') }}
                        <button type="button" onclick="removeFilter('entry_fee')">×</button>
                    </div>
                    @endif

                    @if(request('facilities'))
                    @foreach(request('facilities') as $facility)
                    <div class="filter-tag">
                        {{ $availableFacilities[$facility] }}
                        <button type="button" onclick="removeFacility('{{ $facility }}')">×</button>
                    </div>
                    @endforeach
                    @endif

                    @if(request('open_now'))
                    <div class="filter-tag">
                        Open Now
                        <button type="button" onclick="removeFilter('open_now')">×</button>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Attractions Grid/List -->
                @if($attractions->count() > 0)
                    <div class="attractions-{{ $viewMode == 'grid' ? 'grid' : 'list' }}">
                        @foreach($attractions as $attraction)
                            @if($viewMode == 'grid')
                            <!-- Grid View -->
                            <a href="{{ route('attractions.show', [$country->slug, $district->slug, $category->slug, $attraction->slug]) }}" style="text-decoration: none; color: inherit;">
                            <div class="attraction-card">
                                <div class="attraction-image">
                                    <img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}" loading="lazy">
                                    @if($attraction->isOpenNow())
                                    <span class="attraction-badge">Open Now</span>
                                    @endif
                                </div>
                                <div class="attraction-content">
                                    <h3 class="attraction-name">{{ $attraction->name }}</h3>
                                    @if($attraction->location)
                                    <div class="attraction-location">📍 {{ $attraction->location }}</div>
                                    @endif
                                    <p class="attraction-description">{{ $attraction->description }}</p>

                                    @if($attraction->facilities)
                                    <div class="attraction-facilities">
                                        @foreach($attraction->facilities as $facility)
                                        <span class="facility-icon" title="{{ $availableFacilities[$facility] ?? $facility }}">
                                            @switch($facility)
                                                @case('parking') 🅿️ @break
                                                @case('wifi') 📶 @break
                                                @case('restaurant') 🍽️ @break
                                                @case('guide') 👤 @break
                                                @case('wheelchair') ♿ @break
                                                @case('restroom') 🚻 @break
                                                @default 📌
                                            @endswitch
                                        </span>
                                        @endforeach
                                    </div>
                                    @endif

                                    <div class="attraction-meta">
                                        <div class="attraction-rating">
                                            <span>⭐</span>
                                            <span>{{ number_format($attraction->rating, 1) }}</span>
                                            <span style="color: #6b7280;">({{ number_format($attraction->reviews_count) }})</span>
                                        </div>
                                        <div class="attraction-price">
                                            @if($attraction->entry_fee)
                                                Rs. {{ number_format($attraction->entry_fee) }}
                                            @else
                                                Free
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <!-- List View -->
                            <a href="{{ route('attractions.show', [$country->slug, $district->slug, $category->slug, $attraction->slug]) }}" style="text-decoration: none; color: inherit;">

                            <div class="attraction-card-list">
                                <div class="attraction-image">
                                    <img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}" loading="lazy">
                                    @if($attraction->isOpenNow())
                                    <span class="attraction-badge">Open Now</span>
                                    @endif
                                </div>
                                <div class="attraction-content">
                                    <div>
                                        <h3 class="attraction-name">{{ $attraction->name }}</h3>
                                        @if($attraction->location)
                                        <div class="attraction-location">📍 {{ $attraction->location }}</div>
                                        @endif
                                        <p class="attraction-description">{{ $attraction->description }}</p>

                                        @if($attraction->facilities)
                                        <div class="attraction-facilities">
                                            @foreach($attraction->facilities as $facility)
                                            <span class="facility-icon" title="{{ $availableFacilities[$facility] ?? $facility }}">
                                                @switch($facility)
                                                    @case('parking') 🅿️ @break
                                                    @case('wifi') 📶 @break
                                                    @case('restaurant') 🍽️ @break
                                                    @case('guide') 👤 @break
                                                    @case('wheelchair') ♿ @break
                                                    @case('restroom') 🚻 @break
                                                    @default 📌
                                                @endswitch
                                            </span>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>

                                    <div class="attraction-meta">
                                        <div class="attraction-rating">
                                            <span>⭐</span>
                                            <span>{{ number_format($attraction->rating, 1) }}</span>
                                            <span style="color: #6b7280;">({{ number_format($attraction->reviews_count) }})</span>
                                        </div>
                                        <div class="attraction-price">
                                            @if($attraction->entry_fee)
                                                Rs. {{ number_format($attraction->entry_fee) }}
                                            @else
                                                Free
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        @if($attractions->hasMorePages())
                        <button type="button" class="load-more-btn" onclick="loadMore()">
                            View More Attractions
                        </button>
                        @endif
                    </div>
                @else
                    <!-- No Results -->
                    <div class="no-results">
                        <div class="no-results-icon">🔍</div>
                        <h3>No Attractions Found</h3>
                        <p>Try adjusting your filters or search terms</p>
                    </div>
                @endif
            </div>
        </div>

        <input type="hidden" name="view" value="{{ $viewMode }}">
    </form>
</div>

<script>
    function changeView(view) {
        const form = document.getElementById('filterForm');
        const viewInput = form.querySelector('input[name="view"]');
        viewInput.value = view;
        form.submit();
    }

    function removeFilter(filterName) {
        const form = document.getElementById('filterForm');
        const input = form.querySelector(`[name="${filterName}"]`);
        if (input) {
            if (input.type === 'checkbox') {
                input.checked = false;
            } else {
                input.value = '';
            }
        }
        form.submit();
    }

    function removeFacility(facility) {
        const form = document.getElementById('filterForm');
        const checkboxes = form.querySelectorAll('input[name="facilities[]"]');
        checkboxes.forEach(cb => {
            if (cb.value === facility) {
                cb.checked = false;
            }
        });
        form.submit();
    }

    function loadMore() {
        const currentPage = {{ $attractions->currentPage() }};
        const nextPage = currentPage + 1;
        const url = new URL(window.location.href);
        url.searchParams.set('page', nextPage);
        window.location.href = url.toString();
    }

    // Auto-submit search after typing stops
    let searchTimeout;
    document.querySelector('input[name="search"]').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            document.getElementById('filterForm').submit();
        }, 500);
    });
</script>
@endsection
