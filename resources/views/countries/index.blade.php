<!-- filepath: resources/views/countries/index.blade.php -->
@extends('layouts.app')

@section('title', 'Explore Countries')

@section('styles')
<style>
    /* Countries Page Specific Styles */
    .countries-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        padding: 120px 32px 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .countries-hero::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><path fill="%23ffffff" fill-opacity="0.05" d="M0,300 Q300,100 600,300 T1200,300 L1200,0 L0,0 Z"/></svg>') no-repeat center right;
        opacity: 0.3;
    }

    .countries-hero-content {
        max-width: 1440px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .breadcrumb {
        display: flex;
        gap: 8px;
        font-size: 14px;
        margin-bottom: 16px;
        align-items: center;
    }

    .breadcrumb a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s;
    }

    .breadcrumb a:hover {
        color: white;
    }

    .breadcrumb span {
        color: rgba(255, 255, 255, 0.5);
    }

    .countries-hero h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .countries-hero p {
        font-size: 18px;
        opacity: 0.9;
    }

    .countries-content {
        max-width: 1440px;
        margin: -40px auto 80px;
        padding: 0 32px;
        position: relative;
    }

    .countries-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 32px;
    }

    /* Sidebar Filters */
    .filters-sidebar {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        height: fit-content;
        position: sticky;
        top: 100px;
    }

    .filters-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
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
        color: #374151;
        margin-bottom: 12px;
        display: block;
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input-wrapper input {
        width: 100%;
        padding: 10px 12px 10px 36px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s;
    }

    .search-input-wrapper input:focus {
        border-color: #06b6d4;
        box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
    }

    .search-input-wrapper svg {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #9ca3af;
    }

    .continent-filters {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .continent-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .continent-checkbox:hover {
        background: #f3f4f6;
    }

    .continent-checkbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #06b6d4;
    }

    .continent-checkbox label {
        font-size: 14px;
        color: #374151;
        cursor: pointer;
        flex: 1;
    }

    .sort-select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
    }

    .sort-select:focus {
        border-color: #06b6d4;
        box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
    }

    .clear-filters-btn {
        width: 100%;
        padding: 12px;
        background: #f3f4f6;
        color: #374151;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .clear-filters-btn:hover {
        background: #e5e7eb;
    }

    /* Main Content Area */
    .countries-main {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .countries-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .countries-count {
        font-size: 16px;
        color: #6b7280;
    }

    .countries-count strong {
        color: #1e3a8a;
        font-weight: 700;
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
        color: #6b7280;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 500;
    }

    .view-btn.active {
        background: white;
        color: #1e3a8a;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .view-btn:hover:not(.active) {
        color: #374151;
    }

    /* Grid View */
    .countries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .country-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
    }

    .country-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        border-color: #06b6d4;
    }

    .country-card-image {
        position: relative;
        height: 180px;
        overflow: hidden;
    }

    .country-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .country-card:hover .country-card-image img {
        transform: scale(1.1);
    }

    .country-card-favorite {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .country-card-favorite:hover {
        background: #fee2e2;
        transform: scale(1.1);
    }

    .country-card-content {
        padding: 20px;
    }

    .country-card-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .country-card-tagline {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .country-card-stats {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-top: 12px;
        border-top: 1px solid #e5e7eb;
        font-size: 14px;
        color: #6b7280;
    }

    .country-card-stat {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* List View */
    .countries-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 32px;
    }

    .country-list-item {
        display: grid;
        grid-template-columns: 200px 1fr auto;
        gap: 20px;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        transition: all 0.3s;
        text-decoration: none;
        align-items: center;
        padding-right: 20px;
    }

    .country-list-item:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        border-color: #06b6d4;
    }

    .country-list-image {
        height: 140px;
        overflow: hidden;
    }

    .country-list-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .country-list-item:hover .country-list-image img {
        transform: scale(1.1);
    }

    .country-list-content {
        padding: 20px 0;
    }

    .country-list-title {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .country-list-tagline {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .country-list-description {
        font-size: 14px;
        color: #4b5563;
        line-height: 1.6;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .country-list-stats {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 14px;
        color: #6b7280;
    }

    .country-list-action {
        padding: 12px 24px;
        background: #06b6d4;
        color: white;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        white-space: nowrap;
    }

    .country-list-action:hover {
        background: #0891b2;
        transform: translateY(-2px);
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 32px;
    }

    .pagination {
        display: flex;
        gap: 4px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .page-item {
        display: flex;
    }

    .page-link {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        color: #374151;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
        min-width: 40px;
        text-align: center;
    }

    .page-link:hover {
        background: #f3f4f6;
        border-color: #06b6d4;
        color: #06b6d4;
    }

    .page-item.active .page-link {
        background: #06b6d4;
        color: white;
        border-color: #06b6d4;
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .countries-layout {
            grid-template-columns: 1fr;
        }

        .filters-sidebar {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .countries-hero {
            padding: 100px 20px 40px;
        }

        .countries-hero h1 {
            font-size: 32px;
        }

        .countries-content {
            margin: -20px auto 60px;
            padding: 0 20px;
        }

        .countries-grid {
            grid-template-columns: 1fr;
        }

        .country-list-item {
            grid-template-columns: 1fr;
        }

        .country-list-image {
            height: 200px;
        }

        .country-list-content {
            padding: 20px;
        }

        .country-list-action {
            margin: 0 20px 20px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="countries-hero">
    <div class="countries-hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>›</span>
            <span>Countries</span>
        </div>
        <h1>Explore Countries</h1>
        <p>Discover amazing destinations and explore districts across the globe</p>
    </div>
</div>

<!-- Main Content -->
<div class="countries-content">
    <div class="countries-layout">
        <!-- Filters Sidebar -->
        <aside class="filters-sidebar">
            <div class="filters-title">
                <span>Filters</span>
                @if(request()->hasAny(['search', 'continent', 'sort']))
                <button type="button" class="clear-filters-btn" onclick="window.location.href='{{ route('countries.index') }}'">
                    Clear All
                </button>
                @endif
            </div>

            <form method="GET" action="{{ route('countries.index') }}" id="filterForm">
                <!-- Search -->
                <div class="filter-section">
                    <label class="filter-label">Search</label>
                    <div class="search-input-wrapper">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        <input type="text" name="search" placeholder="Search countries..." value="{{ request('search') }}" onchange="document.getElementById('filterForm').submit()">
                    </div>
                </div>

                <!-- Filter by Region -->
                <div class="filter-section">
                    <label class="filter-label">Filter by Region</label>
                    <div class="continent-filters">
                        @foreach($continents as $continent)
                        <div class="continent-checkbox">
                            <input type="checkbox" name="continent" value="{{ $continent }}" id="continent-{{ $continent }}"
                                {{ request('continent') == $continent ? 'checked' : '' }}
                                onchange="document.getElementById('filterForm').submit()">
                            <label for="continent-{{ $continent }}">{{ $continent }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sort by -->
                <div class="filter-section">
                    <label class="filter-label">Sort by</label>
                    <select name="sort" class="sort-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="alphabetical" {{ request('sort') == 'alphabetical' ? 'selected' : '' }}>Alphabetical</option>
                        <option value="most_districts" {{ request('sort') == 'most_districts' ? 'selected' : '' }}>Most Districts</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>

                <input type="hidden" name="view" value="{{ request('view', 'grid') }}">
            </form>
        </aside>

        <!-- Countries List -->
        <main class="countries-main">
            <div class="countries-header">
                <div class="countries-count">
                    <strong>{{ $countries->total() }}</strong> {{ Str::plural('Country', $countries->total()) }} Found
                </div>

                <div class="view-toggle">
                    <button class="view-btn {{ $viewMode == 'grid' ? 'active' : '' }}" onclick="changeView('grid')">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                            <path d="M0 0h7v7H0V0zm9 0h7v7H9V0zM0 9h7v7H0V9zm9 0h7v7H9V9z"/>
                        </svg>
                        Grid View
                    </button>
                    <button class="view-btn {{ $viewMode == 'list' ? 'active' : '' }}" onclick="changeView('list')">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                            <path d="M0 0h16v3H0V0zm0 6h16v3H0V6zm0 6h16v3H0v-3z"/>
                        </svg>
                        List View
                    </button>
                </div>
            </div>

            @if($countries->count() > 0)
                @if($viewMode == 'grid')
                    <!-- Grid View -->
                    <div class="countries-grid">
                        @foreach($countries as $country)
                        <a href="{{ route('countries.show', $country->slug) }}" class="country-card">
                            <div class="country-card-image">
                                <img src="{{ $country->image_url }}" alt="{{ $country->name }}" loading="lazy">
                                <div class="country-card-favorite">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M10 17.5l-6.5-6.5a4.5 4.5 0 116.36-6.36L10 5.5l.14-.14a4.5 4.5 0 116.36 6.36L10 17.5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="country-card-content">
                                <h3 class="country-card-title">{{ $country->name }}</h3>
                                <p class="country-card-tagline">{{ $country->tagline }}</p>
                                <div class="country-card-stats">
                                    <span class="country-card-stat">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                            <path d="M8 1a3 3 0 013 3v1h3a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V6a1 1 0 011-1h3V4a3 3 0 013-3z"/>
                                        </svg>
                                        {{ $country->districts_count }} Districts
                                    </span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                    <!-- List View -->
                    <div class="countries-list">
                        @foreach($countries as $country)
                        <div class="country-list-item">
                            <div class="country-list-image">
                                <img src="{{ $country->image_url }}" alt="{{ $country->name }}" loading="lazy">
                            </div>
                            <div class="country-list-content">
                                <h3 class="country-list-title">{{ $country->name }}</h3>
                                <p class="country-list-tagline">{{ $country->tagline }}</p>
                                <p class="country-list-description">{{ $country->description }}</p>
                                <div class="country-list-stats">
                                    <span>📍 {{ $country->continent }}</span>
                                    <span>•</span>
                                    <span>🏛️ {{ $country->districts_count }} Districts</span>
                                </div>
                            </div>
                            <a href="{{ route('countries.show', $country->slug) }}" class="country-list-action">
                                Explore Districts
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $countries->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px;">
                    <svg width="64" height="64" style="margin-bottom: 16px; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3 style="color: #374151; margin-bottom: 8px;">No countries found</h3>
                    <p style="color: #6b7280;">Try adjusting your filters or search terms</p>
                    <a href="{{ route('countries.index') }}" style="display: inline-block; margin-top: 16px; padding: 12px 24px; background: #06b6d4; color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">
                        Clear All Filters
                    </a>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function changeView(view) {
        const url = new URL(window.location);
        url.searchParams.set('view', view);
        window.location = url.toString();
    }

    // Auto-submit form when checkboxes change
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Uncheck other continent checkboxes
            if (this.name === 'continent') {
                document.querySelectorAll('input[name="continent"]').forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
            }
            document.getElementById('filterForm').submit();
        });
    });
</script>
@endsection
