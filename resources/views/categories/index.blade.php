{{-- filepath: d:\Programming\oop\MiniProject\oopMiniProject\resources\views\categories\index.blade.php --}}
@extends('layouts.app')

@section('title', $district->name . ' - Categories - TravelEase')

@section('styles')
<style>
    /* Hero Section */
    .district-hero {
        position: relative;
        height: 400px;
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

    .breadcrumb a:hover {
        color: white;
    }

    .district-hero h1 {
        font-size: 56px;
        font-weight: 700;
        margin-bottom: 12px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .district-region {
        font-size: 20px;
        margin-bottom: 8px;
        opacity: 0.9;
    }

    .district-description {
        font-size: 18px;
        max-width: 800px;
        line-height: 1.6;
        opacity: 0.95;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    /* Stats Section */
    .stats-section {
        max-width: 1440px;
        margin: -80px auto 60px;
        padding: 0 32px;
        position: relative;
        z-index: 2;
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
    }

    .stat-card {
        text-align: center;
        padding: 20px;
    }

    .stat-icon {
        font-size: 48px;
        margin-bottom: 16px;
    }

    .stat-value {
        font-size: 36px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 13px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    /* Categories Section */
    .categories-section {
        max-width: 1440px;
        margin: 0 auto 80px;
        padding: 0 32px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .section-title {
        font-size: 36px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 12px;
    }

    .section-subtitle {
        font-size: 16px;
        color: #6b7280;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .category-card {
        background: white;
        border-radius: 20px;
        padding: 40px 28px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 3px solid transparent;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        border-color: var(--category-color);
    }

    .category-icon-wrapper {
        width: 100px;
        height: 100px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--category-color);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .category-card:hover .category-icon-wrapper {
        transform: scale(1.1);
    }

    .category-icon {
        font-size: 56px;
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
        background: var(--category-color);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .explore-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        filter: brightness(1.1);
    }

    /* Popular Attractions Section */
    .attractions-section {
        max-width: 1440px;
        margin: 0 auto 80px;
        padding: 0 32px;
    }

    .attractions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 32px;
    }

    .attraction-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .attraction-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
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

    .attraction-content {
        padding: 24px;
    }

    .attraction-name {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
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

    .attraction-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #f59e0b;
        font-weight: 600;
    }

    .no-categories {
        text-align: center;
        padding: 60px 32px;
        color: #6b7280;
        font-size: 18px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .district-hero {
            height: 350px;
        }

        .district-hero h1 {
            font-size: 36px;
        }

        .stats-cards {
            grid-template-columns: 1fr;
            padding: 24px;
        }

        .categories-grid,
        .attractions-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
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

        <h1>{{ $district->name }} District</h1>
        @if($district->region)
        <p class="district-region">{{ $district->region }}, {{ $country->name }}</p>
        @endif
        <p class="district-description">{{ $district->description }}</p>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon">📂</div>
            <div class="stat-value">{{ $categories->count() }}</div>
            <div class="stat-label">Categories Available</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🎯</div>
            <div class="stat-value">{{ $district->attractions_count }}</div>
            <div class="stat-label">Total Attractions</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🗓️</div>
            <div class="stat-value">{{ $district->best_season ?? 'Year Round' }}</div>
            <div class="stat-label">Best Season to Visit</div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="categories-section">
    <div class="section-header">
        <h2 class="section-title">Explore by Category</h2>
        <p class="section-subtitle">Discover the diverse attractions {{ $district->name }} District has to offer</p>
    </div>

    @if($categories->count() > 0)
    <div class="categories-grid">
        @foreach($categories as $category)
        <div class="category-card" style="--category-color: {{ $category->color }};">
            <div class="category-icon-wrapper">
                <div class="category-icon">{{ $category->icon }}</div>
            </div>
            <h3 class="category-name">{{ $category->name }}</h3>
            <p class="category-count">{{ $category->attractions_count }} {{ Str::plural('Site', $category->attractions_count) }}</p>
            <a href="{{ route('countries.districts.categories.attractions', [$country->slug, $district->slug, $category->slug]) }}" class="explore-btn">
                Explore
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="no-categories">
        <p>No categories available for this district yet.</p>
    </div>
    @endif
</div>

<!-- Popular Attractions Section -->
@if($popularAttractions->count() > 0)
<div class="attractions-section">
    <div class="section-header">
        <h2 class="section-title">Popular Attractions in {{ $district->name }} District</h2>
        <p class="section-subtitle">Must-visit destinations you shouldn't miss</p>
    </div>

    <div class="attractions-grid">
        @foreach($popularAttractions as $attraction)
        <div class="attraction-card">
            <div class="attraction-image">
                <img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}" loading="lazy">
            </div>
            <div class="attraction-content">
                <h3 class="attraction-name">{{ $attraction->name }}</h3>
                <p class="attraction-description">{{ $attraction->description }}</p>
                <div class="attraction-rating">
                    <span>⭐</span>
                    <span>{{ number_format($attraction->rating ?? 4.5, 1) }}</span>
                    @if($attraction->reviews_count)
                    <span style="color: #6b7280;">({{ number_format($attraction->reviews_count) }} reviews)</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
