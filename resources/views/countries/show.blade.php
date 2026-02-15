@extends('layouts.app')

@section('title', $country->name . ' - TravelEase')

@section('styles')
<style>
    .country-hero {
        position: relative;
        height: 500px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white;
    }

    .country-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
    }

    .country-hero-content {
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
        margin-bottom: 24px;
        color: rgba(255, 255, 255, 0.8);
    }

    .breadcrumb a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
    }

    .breadcrumb a:hover {
        color: white;
    }

    .country-title {
        font-size: 56px;
        font-weight: 700;
        margin-bottom: 16px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .country-tagline {
        font-size: 24px;
        font-weight: 500;
        opacity: 0.95;
        margin-bottom: 32px;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    .country-content {
        max-width: 1440px;
        margin: -60px auto 80px;
        padding: 0 32px;
        position: relative;
    }

    /* Info Cards - NOW SHOWN HERE */
    .info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 60px;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: all 0.3s;
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .info-icon {
        font-size: 40px;
        margin-bottom: 16px;
    }

    .info-value {
        font-size: 24px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .info-label {
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .country-main-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 32px;
        margin-bottom: 60px;
    }

    .country-description-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .country-description-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .country-description-text {
        font-size: 16px;
        line-height: 1.8;
        color: #4b5563;
    }

    .country-info-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        height: fit-content;
    }

    .country-info-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 24px;
    }

    .country-info-item {
        display: flex;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .country-info-item:last-child {
        border-bottom: none;
    }

    .country-info-label {
        font-size: 14px;
        color: #6b7280;
        font-weight: 500;
    }

    .country-info-value {
        font-size: 14px;
        color: #1e3a8a;
        font-weight: 600;
        text-align: right;
    }

    .districts-section {
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

    .districts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .district-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
    }

    .district-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        border-color: #06b6d4;
    }

    .district-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 12px;
    }

    .district-stats {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #6b7280;
    }

    .cta-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        border-radius: 16px;
        padding: 48px;
        text-align: center;
        color: white;
        margin-top: 60px;
    }

    .cta-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .cta-description {
        font-size: 18px;
        opacity: 0.95;
        margin-bottom: 32px;
    }

    .cta-button {
        padding: 16px 40px;
        background: white;
        color: #1e3a8a;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 1024px) {
        .country-main-content {
            grid-template-columns: 1fr;
        }
        .info-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .country-hero {
            height: 400px;
        }
        .country-title {
            font-size: 36px;
        }
        .country-tagline {
            font-size: 18px;
        }
        .country-content {
            margin: -40px auto 60px;
            padding: 0 20px;
        }
        .info-cards {
            grid-template-columns: 1fr;
        }
        .districts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="country-hero" style="background-image: url('{{ $country->image_url }}');">
    <div class="country-hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>›</span>
            <a href="{{ route('countries.index') }}">Countries</a>
            <span>›</span>
            <span>{{ $country->name }}</span>
        </div>

        <h1 class="country-title">{{ $country->name }}</h1>
        <p class="country-tagline">{{ $country->tagline ?? 'Discover Amazing Destinations' }}</p>
    </div>
</div>

<div class="country-content">
    <!-- Info Cards - MOVED HERE FROM DISTRICT PAGE -->
    <div class="info-cards">
        <div class="info-card">
            <div class="info-icon">🏛️</div>
            <div class="info-value">{{ $country->districts_count }}</div>
            <div class="info-label">Total Districts</div>
        </div>
        <div class="info-card">
            <div class="info-icon">🎯</div>
            <div class="info-value">{{ $country->attractions_count ?? 0 }}</div>
            <div class="info-label">Total Attractions</div>
        </div>
        <div class="info-card">
            <div class="info-icon">💬</div>
            <div class="info-value">{{ $country->languages ?? 'English' }}</div>
            <div class="info-label">Languages</div>
        </div>
        <div class="info-card">
            <div class="info-icon">💰</div>
            <div class="info-value">{{ $country->currency ?? 'USD' }}</div>
            <div class="info-label">Currency</div>
        </div>
    </div>

    <div class="country-main-content">
        <div class="country-description-card">
            <h2 class="country-description-title">About {{ $country->name }}</h2>
            <p class="country-description-text">
                {{ $country->description ?? 'Explore the beautiful destinations and rich culture of ' . $country->name . '.' }}
            </p>
        </div>

        <div class="country-info-card">
            <h3 class="country-info-title">Quick Information</h3>
            <div class="country-info-item">
                <span class="country-info-label">Continent</span>
                <span class="country-info-value">{{ $country->continent ?? 'N/A' }}</span>
            </div>
            <div class="country-info-item">
                <span class="country-info-label">Total Districts</span>
                <span class="country-info-value">{{ $country->districts_count }}</span>
            </div>
            <div class="country-info-item">
                <span class="country-info-label">Popular For</span>
                <span class="country-info-value">{{ $country->popular_categories ?? 'Culture, Nature' }}</span>
            </div>
        </div>
    </div>

    @if($country->districts->count() > 0)
    <div class="districts-section">
        <div class="section-header">
            <h2 class="section-title">Explore Districts</h2>
            <p class="section-subtitle">Browse through {{ $country->districts_count }} districts in {{ $country->name }}</p>
        </div>

        <div class="districts-grid">
            @foreach($country->districts->take(12) as $district)
            <a href="{{ route('countries.districts.show', [$country->slug, $district->slug]) }}" class="district-card">
                <h3 class="district-name">{{ $district->name }}</h3>
                <div class="district-stats">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M8 1a3 3 0 013 3v1h3a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V6a1 1 0 011-1h3V4a3 3 0 013-3z"/>
                    </svg>
                    <span>{{ $district->attractions_count }} attractions</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="cta-section">
        <h2 class="cta-title">Explore Districts in {{ $country->name }}</h2>
        <p class="cta-description">
            Discover all {{ $country->districts_count }} districts and their unique attractions
        </p>
        <a href="{{ route('countries.districts.index', $country->slug) }}" class="cta-button">
            View All Districts
        </a>
    </div>
</div>
@endsection
