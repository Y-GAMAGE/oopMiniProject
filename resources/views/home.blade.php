@extends('layouts.app')

@section('title', 'Discover Your Next Adventure')

@section('styles')
<style>
    /* ===========================
       HOME PAGE SPECIFIC STYLES
       =========================== */

    /* Hero Section */
    .hero-section {
        position: relative;
        height: 600px;
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                    url('https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .hero-content {
        max-width: 800px;
        padding: 0 24px;
        animation: fadeInUp 1s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-title {
        font-size: 56px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 16px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .hero-subtitle {
        font-size: 20px;
        margin-bottom: 32px;
        opacity: 0.95;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-search {
        display: flex;
        max-width: 600px;
        margin: 0 auto;
        background: white;
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .hero-search input {
        flex: 1;
        padding: 18px 28px;
        border: none;
        font-size: 16px;
        outline: none;
        color: #374151;
    }

    .hero-search input::placeholder {
        color: #9ca3af;
    }

    .hero-search button {
        padding: 18px 40px;
        background: #06b6d4;
        color: white;
        border: none;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .hero-search button:hover {
        background: #0891b2;
    }

    /* Section Styles */
    .section {
        padding: 80px 32px;
        max-width: 1440px;
        margin: 0 auto;
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
        font-size: 18px;
        color: #6b7280;
    }

    /* Popular Destinations Grid - 4 columns, 2 rows = 8 items */
    .destinations-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .destination-card {
        position: relative;
        height: 280px;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-decoration: none;
    }

    .destination-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .destination-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .destination-card:hover img {
        transform: scale(1.1);
    }

    .destination-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.85), transparent);
        padding: 24px;
        color: white;
    }

    .destination-name {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .destination-count {
        font-size: 14px;
        opacity: 0.9;
    }

    /* Browse by Category Section */
    .categories-section {
        background: #f9fafb;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 24px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .category-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .category-item:hover {
        transform: translateY(-8px);
    }

    .category-icon {
        width: 80px;
        height: 80px;
        background: #06b6d4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        color: white;
        font-size: 36px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
    }

    .category-item:hover .category-icon {
        background: #0891b2;
        box-shadow: 0 8px 20px rgba(6, 182, 212, 0.5);
        transform: rotate(5deg) scale(1.1);
    }

    .category-name {
        font-size: 15px;
        font-weight: 600;
        color: #1e3a8a;
        margin-bottom: 4px;
    }

    .category-count {
        font-size: 12px;
        color: #6b7280;
    }

    /* Why Choose Section */
    .why-choose-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        color: white;
    }

    .why-choose-section .section-title {
        color: white;
    }

    .why-choose-section .section-subtitle {
        color: rgba(255, 255, 255, 0.9);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 48px;
    }

    .feature-card {
        background: white;
        border-radius: 16px;
        padding: 32px 24px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        background: #dbeafe;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: #2563eb;
        font-size: 32px;
    }

    .feature-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 12px;
    }

    .feature-description {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .destinations-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .category-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            height: 500px;
        }

        .hero-title {
            font-size: 36px;
        }

        .hero-subtitle {
            font-size: 16px;
        }

        .hero-search {
            flex-direction: column;
            border-radius: 12px;
        }

        .hero-search button {
            border-radius: 0 0 12px 12px;
        }

        .section {
            padding: 48px 20px;
        }

        .section-title {
            font-size: 28px;
        }

        .destinations-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .category-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .category-icon {
            width: 64px;
            height: 64px;
            font-size: 28px;
        }

        .features-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 28px;
        }

        .destinations-grid {
            grid-template-columns: 1fr;
        }

        .category-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .destination-card {
            height: 220px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Discover Your Next<br>Adventure with TravelEase</h1>
        <p class="hero-subtitle">Explore destinations, find attractions, and plan your perfect trip.</p>
        <form action="{{ route('search') }}" method="GET" class="hero-search">
            <input
                type="text"
                name="q"
                placeholder="Search destinations, attractions..."
                aria-label="Search destinations"
            >
            <button type="submit">Search</button>
        </form>
    </div>
</section>

<!-- Popular Destinations Section - 8 Countries -->
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Popular Destinations</h2>
        <p class="section-subtitle">Explore the world's most breathtaking locations</p>
    </div>

    <div class="destinations-grid">
        @forelse($featuredCountries ?? [] as $country)
        <a href="{{ route('countries.show', $country->slug) }}" class="destination-card">
            <img
                src="{{ $country->image_url }}"
                alt="{{ $country->name }}"
                loading="lazy"
            >
            <div class="destination-overlay">
                <div class="destination-name">{{ $country->name }}</div>
                <div class="destination-count">{{ $country->attractions_count }}+ attractions</div>
            </div>
        </a>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
            <p style="color: #6b7280; font-size: 18px;">No destinations available yet.</p>
        </div>
        @endforelse
    </div>
</section>

{{-- <!-- Browse by Category Section - 8 Categories -->
<section class="section categories-section">
    <div class="section-header">
        <h2 class="section-title">Browse by Category</h2>
        <p class="section-subtitle">Find attractions that match your interests</p>
    </div>

    <div class="category-grid">
        @forelse($categories ?? [] as $category)
        <a href="{{ route('categories.show', $category->slug) }}" class="category-item">
            <div class="category-icon">
                {{ $category->icon }}
            </div>
            <div class="category-name">{{ $category->name }}</div>
            <div class="category-count">{{ $category->attractions_count }} attractions</div>
        </a>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
            <p style="color: #6b7280; font-size: 18px;">Categories coming soon!</p>
        </div>
        @endforelse
    </div>
</section> --}}

<!-- Browse by Category Section - 8 Categories -->
<section class="section categories-section">
    <div class="section-header">
        <h2 class="section-title">Browse by Category</h2>
        <p class="section-subtitle">Find attractions that match your interests</p>
    </div>

    <div class="category-grid">
        @forelse($categories ?? [] as $category)
        <a href="{{ route('search', ['category' => $category->slug]) }}" class="category-item">
            <div class="category-icon">
                {{ $category->icon }}
            </div>
            <div class="category-name">{{ $category->name }}</div>
            <div class="category-count">{{ $category->attractions_count }} attractions</div>
        </a>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
            <p style="color: #6b7280; font-size: 18px;">Categories coming soon!</p>
        </div>
        @endforelse
    </div>
</section>

<!-- Why Choose TravelEase Section -->
<section class="section why-choose-section">
    <div class="section-header">
        <h2 class="section-title">Why Choose TravelEase</h2>
        <p class="section-subtitle">Your trusted companion for unforgettable journeys</p>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">ℹ️</div>
            <h3 class="feature-title">Complete Information</h3>
            <p class="feature-description">Comprehensive details about every destination, including history, best times to visit, and insider tips.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🗺️</div>
            <h3 class="feature-title">Easy Navigation</h3>
            <p class="feature-description">Intuitive interface designed to help you find and explore destinations effortlessly with smart search features.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🛡️</div>
            <h3 class="feature-title">Verified Listings</h3>
            <p class="feature-description">All attractions and destinations are verified by our team to ensure accuracy and quality of information.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">📍</div>
            <h3 class="feature-title">Local Insights</h3>
            <p class="feature-description">Get authentic local recommendations and hidden gems that only insiders know about.</p>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add scroll animation
        const observeElements = document.querySelectorAll('.destination-card, .category-item, .feature-card');

        const elementObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '0';
                    entry.target.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        entry.target.style.transition = 'all 0.6s ease';
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 100);

                    elementObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        observeElements.forEach(el => elementObserver.observe(el));
    });
</script>
@endsection
