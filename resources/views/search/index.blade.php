@extends('layouts.app')

@section('title', 'Search Results')

@section('styles')
<style>
    /* Search Results Page Styles */
    .search-results-section {
        padding: 40px 32px 80px;
        max-width: 1440px;
        margin: 0 auto;
        min-height: 60vh;
    }

    .search-header {
        margin-bottom: 40px;
    }

    .search-title {
        font-size: 32px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .search-query {
        font-size: 18px;
        color: #6b7280;
    }

    .search-query strong {
        color: #06b6d4;
        font-weight: 600;
    }

    .results-count {
        font-size: 16px;
        color: #9ca3af;
        margin-top: 8px;
    }

    /* Search Form */
    .search-form-container {
        background: white;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    .search-form {
        display: flex;
        gap: 12px;
    }

    .search-form input {
        flex: 1;
        padding: 14px 20px;
        font-size: 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .search-form input:focus {
        border-color: #06b6d4;
    }

    .search-form button {
        padding: 14px 32px;
        background: #06b6d4;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .search-form button:hover {
        background: #0891b2;
    }

    /* No Results */
    .no-results {
        text-align: center;
        padding: 60px 20px;
        background: #f9fafb;
        border-radius: 12px;
    }

    .no-results-icon {
        font-size: 64px;
        color: #d1d5db;
        margin-bottom: 16px;
    }

    .no-results h3 {
        font-size: 24px;
        color: #374151;
        margin-bottom: 8px;
    }

    .no-results p {
        font-size: 16px;
        color: #6b7280;
    }

    /* Results Sections */
    .results-section {
        margin-bottom: 48px;
    }

    .results-section-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 24px;
        padding-bottom: 12px;
        border-bottom: 3px solid #06b6d4;
    }

    /* Attraction Results */
    .attractions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
    }

    .attraction-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .attraction-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .attraction-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .attraction-content {
        padding: 20px;
    }

    .attraction-name {
        font-size: 18px;
        font-weight: 600;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .attraction-meta {
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
        font-size: 14px;
        color: #6b7280;
    }

    .attraction-meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .attraction-description {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Country & Category Results */
    .list-results {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 16px;
    }

    .list-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        color: inherit;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .list-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .list-card-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .list-card-count {
        font-size: 14px;
        color: #6b7280;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .search-results-section {
            padding: 24px 20px 60px;
        }

        .search-title {
            font-size: 24px;
        }

        .search-form {
            flex-direction: column;
        }

        .attractions-grid,
        .list-results {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<section class="search-results-section">
    <!-- Search Form -->
    <div class="search-form-container">
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input
                type="text"
                name="q"
                placeholder="Search destinations, attractions..."
                value="{{ $query ?? '' }}"
                required
            >
            <button type="submit">Search</button>
        </form>
    </div>

    @if($query)
        <!-- Search Header -->
        <div class="search-header">
            <h1 class="search-title">Search Results</h1>
            <p class="search-query">Showing results for: <strong>"{{ $query }}"</strong></p>
            <p class="results-count">
                Found {{ ($attractions->count() + $countries->count() + $categories->count()) }} results
            </p>
        </div>

        @if($attractions->isEmpty() && $countries->isEmpty() && $categories->isEmpty())
            <!-- No Results -->
            <div class="no-results">
                <div class="no-results-icon">🔍</div>
                <h3>No Results Found</h3>
                <p>We couldn't find any matches for "{{ $query }}". Try different keywords or browse our categories.</p>
            </div>
        @else
            <!-- Attractions Results -->
            @if($attractions->isNotEmpty())
                <div class="results-section">
                    <h2 class="results-section-title">Attractions ({{ $attractions->count() }})</h2>
                    <div class="attractions-grid">
                        @foreach($attractions as $attraction)
                            <a href="{{ route('attractions.show', $attraction->slug) }}" class="attraction-card">
                                <img
                                    src="{{ asset('storage/attractions/' . ($attraction->image ?? 'default.jpg')) }}"
                                    alt="{{ $attraction->name }}"
                                    class="attraction-image"
                                    onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                                >
                                <div class="attraction-content">
                                    <h3 class="attraction-name">{{ $attraction->name }}</h3>
                                    <div class="attraction-meta">
                                        <span>
                                            📍 {{ $attraction->country->name ?? 'Unknown' }}
                                        </span>
                                        <span>
                                            🏷️ {{ $attraction->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>
                                    @if($attraction->description)
                                        <p class="attraction-description">{{ $attraction->description }}</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Countries Results -->
            @if($countries->isNotEmpty())
                <div class="results-section">
                    <h2 class="results-section-title">Countries ({{ $countries->count() }})</h2>
                    <div class="list-results">
                        @foreach($countries as $country)
                            <a href="{{ route('countries.show', $country->slug) }}" class="list-card">
                                <h3 class="list-card-title">{{ $country->name }}</h3>
                                <p class="list-card-count">{{ $country->attractions_count }} attractions</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Categories Results -->
            @if($categories->isNotEmpty())
                <div class="results-section">
                    <h2 class="results-section-title">Categories ({{ $categories->count() }})</h2>
                    <div class="list-results">
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category->slug) }}" class="list-card">
                                <h3 class="list-card-title">{{ $category->name }}</h3>
                                <p class="list-card-count">{{ $category->attractions_count }} attractions</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    @else
        <!-- Empty Search State -->
        <div class="no-results">
            <div class="no-results-icon">🔍</div>
            <h3>Start Your Search</h3>
            <p>Enter keywords to search for destinations, attractions, or categories.</p>
        </div>
    @endif
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Focus on search input
        const searchInput = document.querySelector('.search-form input');
        if (searchInput && !searchInput.value) {
            searchInput.focus();
        }

        // Highlight search terms in results
        const query = "{{ $query ?? '' }}";
        if (query) {
            const regex = new RegExp(`(${query})`, 'gi');
            const elements = document.querySelectorAll('.attraction-name, .list-card-title, .attraction-description');

            elements.forEach(element => {
                const text = element.textContent;
                if (regex.test(text)) {
                    element.innerHTML = text.replace(regex, '<mark style="background: #fef3c7; padding: 2px 4px; border-radius: 2px;">$1</mark>');
                }
            });
        }
    });
</script>
@endsection
