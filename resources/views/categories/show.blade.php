@section('content')
<div class="page-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span>›</span>
        <a href="{{ route('countries.show', $country->slug) }}">{{ $country->name }}</a>
        <span>›</span>
        <a href="{{ route('countries.districts.categories.index', [$country->slug, $district->slug]) }}">{{ $district->name }}</a>
        <span>›</span>
        <span>{{ $category->name }}</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <span class="category-icon-large">{{ $category->icon }}</span>
        <div>
            <h1 class="page-title">{{ $category->name }}</h1>
            <p class="page-subtitle">{{ $district->name }} District • {{ $totalAttractions }} Attractions</p>
        </div>
    </div>

    <!-- Featured Attractions Grid -->
    <div class="attractions-grid">
        @foreach($featuredAttractions as $attraction)
        <div class="attraction-card">
            <div class="attraction-image">
                <img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}">
            </div>
            <div class="attraction-content">
                <h3 class="attraction-name">{{ $attraction->name }}</h3>
                <p class="attraction-description">{{ Str::limit($attraction->description, 100) }}</p>
                <div class="attraction-meta">
                    <span class="rating">⭐ {{ number_format($attraction->rating, 1) }}</span>
                    <span class="price">
                        @if($attraction->entry_fee)
                            Rs. {{ number_format($attraction->entry_fee) }}
                        @else
                            Free
                        @endif
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- View All Button -->
    @if($totalAttractions > 9)
    <div style="text-align: center; margin-top: 40px;">
        <a href="{{ route('countries.districts.categories.attractions', [$country->slug, $district->slug, $category->slug]) }}"
           class="view-all-btn">
            View All {{ $totalAttractions }} {{ $category->name }}
            <span style="margin-left: 8px;">→</span>
        </a>
    </div>
    @endif
</div>

<style>
    .view-all-btn {
        display: inline-block;
        padding: 16px 40px;
        background: {{ $category->color ?? '#1e3a8a' }};
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        filter: brightness(1.1);
    }
</style>
@endsection
