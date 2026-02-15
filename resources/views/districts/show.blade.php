@extends('layouts.app')

@section('title', $district->name . ' District - ' . $country->name)

@section('styles')
<style>
    /* Hero Section */
    .district-hero {
        position: relative;
        height: 450px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white;
    }

    .district-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7));
    }

    .district-hero-content {
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

    .district-title {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .district-region {
        font-size: 18px;
        opacity: 0.9;
        margin-bottom: 16px;
    }

    .district-description {
        font-size: 16px;
        max-width: 700px;
        line-height: 1.6;
    }

    /* Stats Cards */
    .stats-container {
        max-width: 1440px;
        margin: -80px auto 60px;
        padding: 0 32px;
        position: relative;
        z-index: 2;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        text-align: center;
    }

    .stat-icon {
        font-size: 48px;
        margin-bottom: 16px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 14px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Content */
    .district-content {
        max-width: 1440px;
        margin: 0 auto 80px;
        padding: 0 32px;
    }

    .section {
        margin-bottom: 60px;
    }

    .section-header {
        margin-bottom: 32px;
    }

    .section-title {
        font-size: 32px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .section-subtitle {
        font-size: 16px;
        color: #6b7280;
    }

    /* Category Cards */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .category-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        border-color: var(--category-color);
    }

    .category-icon {
        font-size: 56px;
        margin-bottom: 20px;
        display: block;
    }

    .category-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .category-count {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 20px;
    }

    .explore-btn {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .explore-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    /* Popular Attractions */
    .attractions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .attraction-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
    }

    .attraction-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }

    .attraction-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .attraction-content {
        padding: 24px;
    }

    .attraction-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 12px;
    }

    .attraction-description {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 16px;
        line-height: 1.6;
    }

    .attraction-rating {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rating-stars {
        color: #F59E0B;
        font-size: 16px;
    }

    .rating-value {
        font-weight: 600;
        color: #1e3a8a;
    }

    .rating-count {
        color: #6b7280;
        font-size: 14px;
    }

    /* Transport Section */
    .transport-section {
        background: #F3F4F6;
        border-radius: 16px;
        padding: 48px;
    }

    .transport-options {
        display: grid;
        gap: 32px;
    }

    .transport-option {
        display: flex;
        gap: 24px;
        padding: 24px;
        background: white;
        border-radius: 12px;
    }

    .transport-icon {
        font-size: 48px;
        flex-shrink: 0;
    }

    .transport-content h4 {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 12px;
    }

    .transport-content p {
        font-size: 15px;
        color: #4b5563;
        line-height: 1.6;
    }

    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .district-hero {
            height: 350px;
        }
        .district-title {
            font-size: 32px;
        }
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .categories-grid,
        .attractions-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<div class="district-hero" style="background-image: url('{{ $district->image_url }}');">
    <div class="district-hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>›</span>
            <a href="{{ route('countries.index') }}">Countries</a>
            <span>›</span>
            <a href="{{ route('countries.show', $country->slug) }}">{{ $country->name }}</a>
            <span>›</span>
            <span>{{ $district->name }} District</span>
        </div>

        <h1 class="district-title">{{ $district->name }} District</h1>
        <p class="district-region">{{ $district->region }}, {{ $country->name }}</p>
        <p class="district-description">{{ $district->description }}</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-value">{{ $categories->count() }}</div>
            <div class="stat-label">Categories Available</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🎯</div>
            <div class="stat-value">{{ $district->attractions_count }}</div>
            <div class="stat-label">Total Attractions</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">☀️</div>
            <div class="stat-value">{{ $district->best_season ?? 'Dec - Apr' }}</div>
            <div class="stat-label">Best Season to Visit</div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="district-content">
    <!-- Categories -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Explore by Category</h2>
            <p class="section-subtitle">Discover the diverse attractions {{ $district->name }} District has to offer</p>
        </div>

        <div class="categories-grid">
            @foreach($categories as $category)
            <div class="category-card" style="--category-color: {{ $category->color }}">
                <span class="category-icon">{{ $category->icon }}</span>
                <h3 class="category-name">{{ $category->name }}</h3>
                <p class="category-count">{{ $category->attractions_count }} {{ Str::plural('attraction', $category->attractions_count) }}</p>
                <a href="{{ route('countries.districts.categories.attractions', [$country->slug, $district->slug, $category->slug]) }}">
    <button class="explore-btn">Explore</button>

</a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Popular Attractions -->
    @if($popularAttractions->count() > 0)
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Popular Attractions in {{ $district->name }} District</h2>
            <p class="section-subtitle">Must-visit destinations in {{ $district->name }}</p>
        </div>

        <div class="attractions-grid">
            @foreach($popularAttractions as $attraction)
            <div class="attraction-card">
                <img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}" class="attraction-image">
                <div class="attraction-content">
                    <h3 class="attraction-name">{{ $attraction->name }}</h3>
                    <p class="attraction-description">{{ Str::limit($attraction->description, 100) }}</p>
                    <div class="attraction-rating">
                        <span class="rating-stars">⭐</span>
                        <span class="rating-value">{{ $attraction->rating }}</span>
                        <span class="rating-count">({{ number_format($attraction->reviews_count) }} reviews)</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Getting Here -->
    @if(!empty($transportOptions))
    <div class="section">
        <div class="transport-section">
            <div class="section-header">
                <h2 class="section-title">Getting to {{ $district->name }} District</h2>
                <p class="section-subtitle">Transportation options and travel information</p>
            </div>

            <div class="transport-options">
                @if(isset($transportOptions['air']) && $transportOptions['air']['available'])
                <div class="transport-option">
                    <div class="transport-icon">✈️</div>
                    <div class="transport-content">
                        <h4>By Air</h4>
                        <p>{{ $transportOptions['air']['description'] }}</p>
                    </div>
                </div>
                @endif

                @if(isset($transportOptions['train']) && $transportOptions['train']['available'])
                <div class="transport-option">
                    <div class="transport-icon">🚂</div>
                    <div class="transport-content">
                        <h4>By Train</h4>
                        <p>{{ $transportOptions['train']['description'] }}</p>
                    </div>
                </div>
                @endif

                @if(isset($transportOptions['road']) && $transportOptions['road']['available'])
                <div class="transport-option">
                    <div class="transport-icon">🚗</div>
                    <div class="transport-content">
                        <h4>By Road</h4>
                        <p>{{ $transportOptions['road']['description'] }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
