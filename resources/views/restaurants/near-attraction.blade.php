{{-- filepath: resources\views\restaurants\near-attraction.blade.php --}}
@extends('layouts.app')

@section('title', 'Dining Options near ' . $attraction->name . ' - TravelEase')

@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        background: #f5f7fa;
    }

    /* Header Section */
    .page-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 60px 0 40px;
    }

    .header-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 32px;
    }

    .header-content h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .header-subtitle {
        font-size: 18px;
        opacity: 0.9;
    }

    /* Reference Card */
    .reference-card {
        max-width: 1400px;
        margin: -30px auto 40px;
        padding: 0 32px;
    }

    .reference-inner {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .reference-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .reference-image {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
    }

    .reference-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .reference-info h3 {
        font-size: 20px;
        color: #1e3a8a;
        margin-bottom: 6px;
    }

    .reference-meta {
        color: #6b7280;
        font-size: 14px;
    }

    .back-btn {
        padding: 12px 24px;
        background: white;
        color: #1e3a8a;
        border: 2px solid #1e3a8a;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .back-btn:hover {
        background: #1e3a8a;
        color: white;
    }

    /* Main Container */
    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 32px 80px;
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 32px;
    }

    /* Filters Sidebar */
    .filters-sidebar {
        background: white;
        border-radius: 16px;
        padding: 24px;
        height: fit-content;
        position: sticky;
        top: 20px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .filters-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .filters-header h3 {
        font-size: 20px;
        color: #1e3a8a;
    }

    .clear-filters {
        color: #ef4444;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
    }

    .filter-group {
        margin-bottom: 28px;
    }

    .filter-group-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 12px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .filter-option input[type="checkbox"],
    .filter-option input[type="radio"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .filter-option label {
        font-size: 14px;
        color: #374151;
        cursor: pointer;
    }

    .apply-filters-btn {
        width: 100%;
        padding: 14px;
        background: #1e3a8a;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .apply-filters-btn:hover {
        background: #1e40af;
    }

    /* Results Section */
    .results-section {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .results-count {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
    }

    .active-filters {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        flex: 1;
        justify-content: center;
    }

    .filter-tag {
        padding: 6px 12px;
        background: #e0e7ff;
        color: #1e3a8a;
        border-radius: 20px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-tag .remove {
        cursor: pointer;
        font-weight: 700;
        text-decoration: none;
    }

    /* Restaurant Cards */
    .restaurants-grid {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .restaurant-card {
        display: grid;
        grid-template-columns: 280px 1fr 200px;
        gap: 24px;
        padding: 20px;
        border: 2px solid #f3f4f6;
        border-radius: 16px;
        transition: all 0.3s;
        position: relative;
    }

    .restaurant-card:hover {
        border-color: #1e3a8a;
        box-shadow: 0 8px 24px rgba(30, 58, 138, 0.15);
    }

    .restaurant-image {
        width: 280px;
        height: 200px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }

    .restaurant-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .restaurant-card:hover .restaurant-image img {
        transform: scale(1.1);
    }

    .type-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 6px 12px;
        background: rgba(30, 58, 138, 0.9);
        color: white;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .restaurant-info {
        flex: 1;
    }

    .restaurant-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 12px;
    }

    .restaurant-name {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .save-icon {
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .save-icon:hover {
        transform: scale(1.2);
    }

    .cuisine-tags {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .cuisine-tag {
        padding: 4px 12px;
        background: #fef3c7;
        color: #92400e;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .restaurant-location {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-size: 14px;
        color: #6b7280;
    }

    .map-icon {
        color: #3b82f6;
        cursor: pointer;
        text-decoration: none;
    }

    .restaurant-address {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .restaurant-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }

    .rating-stars {
        color: #f59e0b;
        font-size: 16px;
        font-weight: 600;
    }

    .reviews-count {
        color: #6b7280;
        font-size: 13px;
    }

    .price-range {
        color: #059669;
        font-weight: 700;
        font-size: 16px;
    }

    .restaurant-description {
        font-size: 14px;
        color: #374151;
        line-height: 1.6;
        margin-bottom: 12px;
    }

    .restaurant-hours {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .open-badge {
        padding: 4px 8px;
        background: #d1fae5;
        color: #065f46;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .closed-badge {
        padding: 4px 8px;
        background: #fee2e2;
        color: #991b1b;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .facilities {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .facility-icon {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        color: #6b7280;
    }

    .restaurant-actions {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
    }

    .distance-price {
        text-align: right;
    }

    .distance {
        font-size: 18px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 4px;
    }

    .walk-time {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .average-cost {
        font-size: 20px;
        font-weight: 700;
        color: #059669;
        margin-bottom: 4px;
    }

    .cost-label {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .famous-for {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .famous-item {
        font-size: 14px;
        color: #1e3a8a;
        font-weight: 700;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 16px;
    }

    .btn {
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
        border: none;
        display: inline-block;
    }

    .btn-primary {
        background: #1e3a8a;
        color: white;
    }

    .btn-primary:hover {
        background: #1e40af;
    }

    .btn-secondary {
        background: white;
        color: #1e3a8a;
        border: 2px solid #1e3a8a;
    }

    .btn-secondary:hover {
        background: #eff6ff;
    }

    .btn-call {
        background: #059669;
        color: white;
    }

    .btn-call:hover {
        background: #047857;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 40px;
    }

    .page-link {
        padding: 10px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        color: #374151;
        text-decoration: none;
        transition: all 0.3s;
    }

    .page-link:hover,
    .page-link.active {
        background: #1e3a8a;
        color: white;
        border-color: #1e3a8a;
    }

    /* No Results */
    .no-results {
        text-align: center;
        padding: 60px 20px;
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
        .main-container {
            grid-template-columns: 1fr;
        }

        .filters-sidebar {
            position: relative;
            top: 0;
        }

        .restaurant-card {
            grid-template-columns: 1fr;
        }

        .restaurant-actions {
            align-items: flex-start;
        }
    }

    @media (max-width: 768px) {
        .header-content h1 {
            font-size: 32px;
        }

        .reference-inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .restaurant-image {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="header-content">
        <h1>Dining Options near {{ $attraction->name }}</h1>
        <p class="header-subtitle">Discover great places to eat near {{ $attraction->name }}</p>
    </div>
</div>

<!-- Reference Card -->
<div class="reference-card">
    <div class="reference-inner">
        <div class="reference-left">
            <div class="reference-image">
                <img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}">
            </div>
            <div class="reference-info">
                <h3>{{ $attraction->name }}</h3>
                <p class="reference-meta">Reference point for dining options</p>
            </div>
        </div>
        <a href="{{ route('attractions.show', [$country->slug, $district->slug, $category->slug, $attraction->slug]) }}" class="back-btn">
            <span>←</span>
            <span>Back to Attraction</span>
        </a>
    </div>
</div>

<!-- Main Container -->
<div class="main-container">
    <!-- Filters Sidebar -->
    <aside class="filters-sidebar">
        <form method="GET" action="{{ route('restaurants.near-attraction', [$country->slug, $district->slug, $category->slug, $attraction->slug]) }}" id="filter-form">
            <div class="filters-header">
                <h3>Filters</h3>
                <a href="{{ route('restaurants.near-attraction', [$country->slug, $district->slug, $category->slug, $attraction->slug]) }}" class="clear-filters">Clear All</a>
            </div>

            <!-- Distance Filter -->
            <div class="filter-group">
                <div class="filter-group-title">Distance from {{ $attraction->name }}</div>
                <div class="filter-option">
                    <input type="radio" name="distance" value="0.5" id="distance-500" {{ request('distance') == 0.5 ? 'checked' : '' }}>
                    <label for="distance-500">Within 500m (5-min walk)</label>
                </div>
                <div class="filter-option">
                    <input type="radio" name="distance" value="1" id="distance-1km" {{ request('distance') == 1 || !request('distance') ? 'checked' : '' }}>
                    <label for="distance-1km">Within 1km (10-min walk)</label>
                </div>
                <div class="filter-option">
                    <input type="radio" name="distance" value="2" id="distance-2km" {{ request('distance') == 2 ? 'checked' : '' }}>
                    <label for="distance-2km">Within 2km</label>
                </div>
            </div>

            <!-- Establishment Type -->
            <div class="filter-group">
                <div class="filter-group-title">Establishment Type</div>
                <div class="filter-option">
                    <input type="checkbox" name="type[]" value="restaurant" id="type-restaurant" {{ in_array('restaurant', request('type', [])) ? 'checked' : '' }}>
                    <label for="type-restaurant">Restaurant</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="type[]" value="cafe" id="type-cafe" {{ in_array('cafe', request('type', [])) ? 'checked' : '' }}>
                    <label for="type-cafe">Café</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="type[]" value="food_stall" id="type-stall" {{ in_array('food_stall', request('type', [])) ? 'checked' : '' }}>
                    <label for="type-stall">Food Stall</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="type[]" value="tea_shop" id="type-tea" {{ in_array('tea_shop', request('type', [])) ? 'checked' : '' }}>
                    <label for="type-tea">Tea Shop</label>
                </div>
            </div>

            <!-- Cuisine Type -->
            <div class="filter-group">
                <div class="filter-group-title">Cuisine Type</div>
                <div class="filter-option">
                    <input type="checkbox" name="cuisine[]" value="Local Cuisine" id="cuisine-local" {{ in_array('Local Cuisine', request('cuisine', [])) ? 'checked' : '' }}>
                    <label for="cuisine-local">Local/Traditional</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="cuisine[]" value="Chinese" id="cuisine-chinese" {{ in_array('Chinese', request('cuisine', [])) ? 'checked' : '' }}>
                    <label for="cuisine-chinese">Chinese</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="cuisine[]" value="South Indian" id="cuisine-indian" {{ in_array('South Indian', request('cuisine', [])) ? 'checked' : '' }}>
                    <label for="cuisine-indian">South Indian</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="cuisine[]" value="International" id="cuisine-int" {{ in_array('International', request('cuisine', [])) ? 'checked' : '' }}>
                    <label for="cuisine-int">International</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="cuisine[]" value="Vegetarian" id="cuisine-veg" {{ in_array('Vegetarian', request('cuisine', [])) ? 'checked' : '' }}>
                    <label for="cuisine-veg">Vegetarian</label>
                </div>
            </div>

            <!-- Price Range -->
            <div class="filter-group">
                <div class="filter-group-title">Price Range</div>
                <div class="filter-option">
                    <input type="checkbox" name="price_range[]" value="1" id="price-1" {{ in_array('1', request('price_range', [])) ? 'checked' : '' }}>
                    <label for="price-1">$ Budget (Under ₹500)</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="price_range[]" value="2" id="price-2" {{ in_array('2', request('price_range', [])) ? 'checked' : '' }}>
                    <label for="price-2">$$ Moderate (₹500-1500)</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="price_range[]" value="3" id="price-3" {{ in_array('3', request('price_range', [])) ? 'checked' : '' }}>
                    <label for="price-3">$$$ Upscale (₹1500-3000)</label>
                </div>
            </div>

            <!-- Features -->
            <div class="filter-group">
                <div class="filter-group-title">Features</div>
                <div class="filter-option">
                    <input type="checkbox" name="open_now" value="1" id="open-now" {{ request('open_now') ? 'checked' : '' }}>
                    <label for="open-now">Open Now</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="features[]" value="english_menu" id="feat-menu" {{ in_array('english_menu', request('features', [])) ? 'checked' : '' }}>
                    <label for="feat-menu">English Menu</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="features[]" value="ac" id="feat-ac" {{ in_array('ac', request('features', [])) ? 'checked' : '' }}>
                    <label for="feat-ac">Air Conditioned</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" name="features[]" value="wifi" id="feat-wifi" {{ in_array('wifi', request('features', [])) ? 'checked' : '' }}>
                    <label for="feat-wifi">WiFi Available</label>
                </div>
            </div>

            <button type="submit" class="apply-filters-btn">Apply Filters</button>
        </form>
    </aside>

    <!-- Results Section -->
    <section class="results-section">
        <div class="results-header">
            <h2 class="results-count">{{ $restaurants->total() }} Dining Options Found Near {{ $attraction->name }}</h2>

            @if(isset($activeFilters) && count($activeFilters) > 0)
            <div class="active-filters">
                @foreach($activeFilters as $filter)
                <div class="filter-tag">
                    <span>{{ $filter['label'] }}</span>
                    <a href="{{ request()->fullUrlWithQuery([$filter['param'] => null]) }}" class="remove">×</a>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        @if($restaurants->count() > 0)
        <div class="restaurants-grid">
            @foreach($restaurants as $restaurant)
            <div class="restaurant-card">
                <!-- Image -->
                <div class="restaurant-image">
                    <img src="{{ $restaurant->image_url ?? 'https://via.placeholder.com/280x200' }}" alt="{{ $restaurant->name }}">
                    <div class="type-badge">{{ ucfirst(str_replace('_', ' ', $restaurant->type ?? 'restaurant')) }}</div>
                </div>

                <!-- Info -->
                <div class="restaurant-info">
                    <div class="restaurant-header">
                        <div>
                            <h3 class="restaurant-name">{{ $restaurant->name }}</h3>
                        </div>
                        @auth
                        <span class="save-icon" onclick="toggleSave('Restaurant', {{ $restaurant->id }})">🤍</span>
                        @else
                        <a href="{{ route('login') }}" class="save-icon">🤍</a>
                        @endauth
                    </div>

                    @if($restaurant->cuisine_type && is_array($restaurant->cuisine_type))
                    <div class="cuisine-tags">
                        @foreach($restaurant->cuisine_type as $cuisine)
                        <span class="cuisine-tag">{{ $cuisine }}</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="restaurant-location">
    <span>📍</span>
    <span>{{ number_format($restaurant->distance_from_attraction ?? 0, 0) }}m from {{ $attraction->name }}</span>
    <span>• {{ $restaurant->walk_time_minutes ?? 1 }}-minute walk</span>
</div>

                    <div class="restaurant-address">{{ $restaurant->address }}</div>

                    <div class="restaurant-rating">
                        <span class="rating-stars">⭐ {{ number_format($restaurant->rating, 1) }}</span>
                        <span class="reviews-count">({{ number_format($restaurant->reviews_count) }} reviews)</span>
                        <span class="price-range">{{ str_repeat('$', $restaurant->price_range ?? 2) }}</span>
                    </div>

                    <p class="restaurant-description">{{ Str::limit($restaurant->description, 150) }}</p>

                    <div class="restaurant-hours">
                        @if(method_exists($restaurant, 'isOpenNow') && $restaurant->isOpenNow())
                        <span class="open-badge">● Open Now</span>
                        <span>{{ $restaurant->opening_time ? \Carbon\Carbon::parse($restaurant->opening_time)->format('g:i A') : '' }} - {{ $restaurant->closing_time ? \Carbon\Carbon::parse($restaurant->closing_time)->format('g:i A') : '' }}</span>
                        @else
                        <span class="closed-badge">● Closed</span>
                        <span>Opens at {{ $restaurant->opening_time ? \Carbon\Carbon::parse($restaurant->opening_time)->format('g:i A') : 'N/A' }}</span>
                        @endif
                    </div>

                    <div class="facilities">
                        @if($restaurant->facilities && is_array($restaurant->facilities))
                            @if(in_array('ac', $restaurant->facilities))
                            <span class="facility-icon">❄️ AC</span>
                            @endif
                            @if(in_array('wifi', $restaurant->facilities))
                            <span class="facility-icon">📶 WiFi</span>
                            @endif
                            @if(in_array('parking', $restaurant->facilities))
                            <span class="facility-icon">🅿️ Parking</span>
                            @endif
                            @if(in_array('cards', $restaurant->facilities))
                            <span class="facility-icon">💳 Cards</span>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="restaurant-actions">
                    <div class="distance-price">
    <div class="distance">{{ number_format($restaurant->distance_from_attraction ?? 0, 0) }}m</div>
    <div class="walk-time">🚶 {{ $restaurant->walk_time_minutes ?? 1 }} min walk</div>

    @if($restaurant->price_range == 1)
    <div class="average-cost">₹300 for two</div>
    @elseif($restaurant->price_range == 2)
    <div class="average-cost">₹800 for two</div>
    @else
    <div class="average-cost">₹1500 for two</div>
    @endif
    <div class="cost-label">Average cost</div>

    @if($restaurant->famous_for)
    <div class="famous-for">Famous for:</div>
    <div class="famous-item">{{ $restaurant->famous_for }}</div>
    @endif
</div>

                    <div class="action-buttons">
                        @if($restaurant->website)
                        <a href="{{ $restaurant->website }}" class="btn btn-primary" target="_blank">View Menu</a>
                        @endif
                        @if($restaurant->latitude && $restaurant->longitude)
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $restaurant->latitude }},{{ $restaurant->longitude }}" class="btn btn-secondary" target="_blank">Get Directions</a>
                        @endif
                        @if($restaurant->phone)
                        <a href="tel:{{ $restaurant->phone }}" class="btn btn-call">Call Now</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination">
            @if ($restaurants->onFirstPage())
                <span class="page-link disabled">Previous</span>
            @else
                <a href="{{ $restaurants->previousPageUrl() }}" class="page-link">Previous</a>
            @endif

            @for ($i = 1; $i <= $restaurants->lastPage(); $i++)
                <a href="{{ $restaurants->url($i) }}" class="page-link {{ $i == $restaurants->currentPage() ? 'active' : '' }}">{{ $i }}</a>
            @endfor

            @if ($restaurants->hasMorePages())
                <a href="{{ $restaurants->nextPageUrl() }}" class="page-link">Next</a>
            @else
                <span class="page-link disabled">Next</span>
            @endif
        </div>
        @else
        <div class="no-results">
            <div class="no-results-icon">🍽️</div>
            <h3>No Restaurants Found</h3>
            <p>Try adjusting your filters or distance range</p>
        </div>
        @endif
    </section>
</div>
@endsection

@section('scripts')
<script>
    function toggleSave(type, id) {
        // Add your save functionality here
        console.log('Saving', type, id);
    }
</script>
@endsection
