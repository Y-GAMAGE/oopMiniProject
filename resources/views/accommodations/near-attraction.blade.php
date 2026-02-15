@extends('layouts.app')

@section('title', 'Accommodations Near ' . $attraction->name)

@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f5f5f5;
        color: #262626;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #003580 0%, #0057b8 100%);
        padding: 40px 0 30px 0;
    }

    .page-header h1 {
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 6px;
        color: white;
    }

    .page-header .lead {
        font-size: 15px;
        margin-bottom: 3px;
        opacity: 0.95;
        color: white;
    }

    .page-header p:last-child {
        font-size: 13px;
        opacity: 0.9;
        color: white;
    }

    /* Attraction Info Bar */
    .attraction-info-bar {
        background: white;
        border-bottom: 1px solid #e0e0e0;
        padding: 12px 0;
    }

    .attraction-info-bar img {
        border-radius: 6px;
        border: 1px solid #e0e0e0;
    }

    .attraction-info-bar h5 {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 2px;
        color: #262626;
    }

    .attraction-info-bar .text-muted {
        font-size: 12px;
        color: #6b6b6b;
    }

    .attraction-info-bar .btn-outline-primary {
        font-size: 13px;
        padding: 6px 16px;
        border-radius: 3px;
        color: #0071c2;
        border: 1px solid #0071c2;
        background: white;
    }

    .attraction-info-bar .btn-outline-primary:hover {
        background: #0071c2;
        color: white;
    }

    /* Main Container */
    .container.my-4 {
        max-width: 1400px;
        padding: 20px 15px;
    }

    /* Results Header */
    .results-header {
        margin-bottom: 12px;
    }

    .results-header h4 {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 0;
        color: #262626;
    }

    /* Distance References - Horizontal Inline */
    .distance-references {
        background: #ebf3ff;
        padding: 12px 16px;
        border-radius: 4px;
        border: 1px solid #bdd7f5;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
    }

    .distance-references .ref-label {
        color: #0071c2;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .distance-ref {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #262626;
    }

    .distance-ref .count {
        display: inline-block;
        background: white;
        border: 1px solid #c7c7c7;
        border-radius: 2px;
        padding: 2px 8px;
        font-weight: 700;
        font-size: 13px;
        color: #262626;
        min-width: 28px;
        text-align: center;
    }

    .distance-ref .label {
        font-weight: 400;
        color: #474747;
    }

    /* Two Column Layout Container */
    .main-content-row {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }

    /* Filters Sidebar - LEFT (20%) */
    .filters-column {
        flex: 0 0 280px;
        min-width: 280px;
    }

    .filters-sidebar {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        padding: 18px 16px;
        position: sticky;
        top: 20px;
    }

    .filters-sidebar > h5 {
        font-weight: 700;
        font-size: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #0071c2;
        margin-bottom: 14px;
        color: #262626;
    }

    .filter-section {
        padding-bottom: 12px;
        margin-bottom: 12px;
        border-bottom: 1px solid #e0e0e0;
    }

    .filter-section:last-of-type {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .filter-title {
        font-weight: 700;
        font-size: 12px;
        margin-bottom: 10px;
        color: #262626;
    }

    /* Distance Slider */
    .distance-slider {
        padding: 8px 0;
    }

    .form-range {
        width: 100%;
        height: 3px;
        background: #e0e0e0;
        border-radius: 3px;
        outline: none;
    }

    .form-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 14px;
        height: 14px;
        background: #0071c2;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid white;
        box-shadow: 0 0 0 1px #0071c2;
    }

    .form-range::-moz-range-thumb {
        width: 14px;
        height: 14px;
        background: #0071c2;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid white;
        box-shadow: 0 0 0 1px #0071c2;
    }

    #distanceValue {
        font-weight: 700;
        color: #0071c2;
        font-size: 11px;
    }

    .distance-slider .d-flex span {
        font-size: 10px;
        color: #6b6b6b;
    }

    /* Form Checkboxes */
    .form-check {
        margin-bottom: 8px;
        padding-left: 20px;
    }

    .form-check-input {
        width: 14px;
        height: 14px;
        border: 1px solid #bdbdbd;
        cursor: pointer;
        margin-top: 2px;
    }

    .form-check-input:checked {
        background-color: #0071c2;
        border-color: #0071c2;
    }

    .form-check-label {
        cursor: pointer;
        font-size: 12px;
        color: #262626;
        font-weight: 400;
    }

    /* Price Inputs */
    .price-inputs .input-group {
        border: 1px solid #bdbdbd;
        border-radius: 3px;
        overflow: hidden;
    }

    .price-inputs .input-group-text {
        background: #f5f5f5;
        border: none;
        font-size: 12px;
        padding: 6px 8px;
        color: #262626;
    }

    .price-inputs .form-control {
        border: none;
        font-size: 12px;
        padding: 6px 8px;
    }

    .price-inputs .form-control:focus {
        box-shadow: none;
        outline: none;
    }

    /* Buttons */
    .btn-primary {
        background: #0071c2;
        border: 1px solid #0071c2;
        color: white;
        font-weight: 600;
        padding: 9px 16px;
        border-radius: 3px;
        font-size: 12px;
        width: 100%;
    }

    .btn-primary:hover {
        background: #005999;
        border-color: #005999;
    }

    .btn-outline-secondary {
        color: #0071c2;
        border: 1px solid #0071c2;
        background: white;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 3px;
        font-size: 12px;
        width: 100%;
    }

    .btn-outline-secondary:hover {
        background: #f5f5f5;
    }

    /* Accommodations List - RIGHT (80%) */
    .accommodations-column {
        flex: 1;
        min-width: 0;
    }

    .accommodations-list {
        background: transparent;
    }

    /* Accommodation Cards - Horizontal Layout */
    .accommodation-card {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 12px;
        transition: box-shadow 0.2s;
        display: flex;
    }

    .accommodation-card:hover {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* Image Section - 30% */
    .card-image {
        flex: 0 0 280px;
        position: relative;
        overflow: hidden;
    }

    .card-image img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }

    .card-image .badge {
        position: absolute;
        top: 8px;
        left: 8px;
        font-size: 10px;
        padding: 4px 8px;
        background: #003580;
        border-radius: 2px;
        font-weight: 600;
        color: white;
        z-index: 1;
    }

    /* Details Section - 45% */
    .card-details {
        flex: 1;
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
    }

    .card-details .card-title {
        color: #0071c2;
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 6px;
        cursor: pointer;
        line-height: 1.3;
    }

    .card-details .card-title:hover {
        color: #003580;
        text-decoration: underline;
    }

    .card-details .rating {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 6px;
        flex-wrap: wrap;
    }

    .card-details .stars {
        font-size: 13px;
        color: #febb02;
        letter-spacing: 1px;
    }

    .card-details .rating .text-muted {
        font-size: 10px;
        color: #6b6b6b;
    }

    .card-details .rating .badge {
        font-size: 9px;
        padding: 2px 5px;
        border-radius: 2px;
        font-weight: 700;
        background: #008009;
        color: white;
    }

    .card-details .distance a {
        color: #0071c2;
        text-decoration: none;
        font-size: 11px;
        font-weight: 500;
    }

    .card-details .distance a:hover {
        text-decoration: underline;
    }

    .card-details .address {
        font-size: 10px;
        color: #6b6b6b;
        margin-bottom: 6px;
    }

    .card-details .card-text {
        font-size: 11px;
        color: #474747;
        line-height: 1.4;
        margin-bottom: 8px;
    }

    .card-details .facilities .badge {
        font-size: 9px;
        padding: 2px 5px;
        border: 1px solid #e0e0e0;
        background: white;
        color: #262626;
        border-radius: 2px;
        font-weight: 500;
        margin-right: 3px;
        margin-bottom: 3px;
    }

    .card-details .tags .badge {
        font-size: 9px;
        padding: 2px 5px;
        background: #ebf3ff;
        color: #003580;
        border-radius: 2px;
        font-weight: 600;
        margin-right: 3px;
    }

    /* Price Section - 25% */
    .card-price {
        flex: 0 0 180px;
        border-left: 1px solid #e0e0e0;
        background: #fafafa;
        padding: 14px 12px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .distance-badge {
        padding: 8px;
        background: white;
        border-radius: 3px;
        text-align: center;
        border: 1px solid #e0e0e0;
        margin-bottom: 10px;
    }

    .distance-badge .badge {
        font-size: 11px;
        padding: 5px 8px;
        font-weight: 700;
        border-radius: 2px;
    }

    .distance-badge .badge.bg-success {
        background: #008009 !important;
    }

    .distance-badge .badge.bg-info {
        background: #0071c2 !important;
    }

    .distance-badge small {
        display: block;
        margin-top: 3px;
        font-size: 9px;
        color: #6b6b6b;
    }

    .card-price .price {
        font-size: 22px;
        font-weight: 700;
        color: #262626;
        margin: 8px 0 2px 0;
        text-align: center;
    }

    .card-price .text-center small {
        font-size: 9px;
        color: #6b6b6b;
    }

    .availability {
        margin: 8px 0;
        text-align: center;
    }

    .availability .badge {
        font-size: 10px;
        padding: 4px 8px;
        border-radius: 2px;
        font-weight: 600;
    }

    .availability .badge.bg-success {
        background: #008009 !important;
    }

    .availability .badge.bg-danger {
        background: #cc0000 !important;
    }

    .card-price .btn {
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 2px;
        width: 100%;
        margin-bottom: 6px;
    }

    .card-price .btn-primary {
        background: #0071c2;
        border: 1px solid #0071c2;
        color: white;
    }

    .card-price .btn-outline-primary {
        color: #0071c2;
        border: 1px solid #0071c2;
        background: white;
    }

    /* Alert */
    .alert-info {
        background: #ebf3ff;
        border: 1px solid #0071c2;
        color: #003580;
        border-radius: 3px;
        padding: 14px;
        font-size: 12px;
    }

    /* Pagination */
    .pagination {
        gap: 3px;
    }

    .page-link {
        color: #0071c2;
        border: 1px solid #e0e0e0;
        border-radius: 2px;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 500;
    }

    .page-link:hover {
        background: #f5f5f5;
        border-color: #0071c2;
    }

    .page-item.active .page-link {
        background: #0071c2;
        border-color: #0071c2;
        color: white;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .main-content-row {
            flex-direction: column;
        }

        .filters-column {
            flex: 1;
            width: 100%;
            min-width: 100%;
            margin-bottom: 16px;
        }

        .filters-sidebar {
            position: relative;
        }

        .accommodation-card {
            flex-direction: column;
        }

        .card-image {
            flex: 1;
        }

        .card-image img {
            height: 180px;
        }

        .card-price {
            border-left: none;
            border-top: 1px solid #e0e0e0;
            background: white;
        }
    }
</style>
@endsection

@section('content')
<div class="accommodation-page">
    {{-- Header --}}
    <div class="page-header">
        <div class="container">
            <h1>Accommodations Near {{ $attraction->name }}</h1>
            <p class="lead">{{ $category->name }} in {{ $district->name }}</p>
            <p>Find the perfect place to stay near {{ $attraction->name }}</p>
        </div>
    </div>

    {{-- Attraction Info Bar --}}
    <div class="attraction-info-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 d-flex align-items-center">
                    @if($attraction->image_url)
                    <img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
                    @endif
                    <div>
                        <h5>{{ $attraction->name }}</h5>
                        <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{ $attraction->location }}</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('attractions.show', [$country->slug, $district->slug, $category->slug, $attraction->slug]) }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to Attraction
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        {{-- Results Count --}}
        <div class="results-header">
            <h4>{{ $accommodations->total() }} Accommodations Found Near {{ $attraction->name }}</h4>
        </div>

        {{-- Distance References - Horizontal --}}
        <div class="distance-references">
            <span class="ref-label"><i class="fas fa-location-arrow"></i> Distance Reference</span>
            <div class="distance-ref">
                <span class="count">{{ $distanceReferences['within_1km'] }}</span>
                <span class="label">Within 1 km</span>
            </div>
            <div class="distance-ref">
                <span class="count">{{ $distanceReferences['1_to_3km'] }}</span>
                <span class="label">1-3 km</span>
            </div>
            <div class="distance-ref">
                <span class="count">{{ $distanceReferences['3_to_5km'] }}</span>
                <span class="label">3-5 km</span>
            </div>
            <div class="distance-ref">
                <span class="count">{{ $distanceReferences['5plus_km'] }}</span>
                <span class="label">5+ km</span>
            </div>
        </div>

        {{-- Two Column Layout with Flexbox --}}
        <div class="main-content-row">
            {{-- LEFT: Filters Sidebar --}}
            <div class="filters-column">
                <div class="filters-sidebar">
                    <h5>Filters</h5>
                    <form method="GET" action="{{ url()->current() }}">
                        {{-- Distance --}}
                        <div class="filter-section">
                            <h6 class="filter-title">Distance from Attraction</h6>
                            <div class="distance-slider">
                                <input type="range" class="form-range" name="max_distance" min="1" max="20" value="{{ $filters['max_distance'] ?? 10 }}" id="distanceRange">
                                <div class="d-flex justify-content-between mt-1">
                                    <span>1 km</span>
                                    <span id="distanceValue">Within {{ $filters['max_distance'] ?? 10 }} km</span>
                                    <span>20 km</span>
                                </div>
                            </div>
                        </div>

                        {{-- Property Type --}}
                        <div class="filter-section">
                            <h6 class="filter-title">Property Type</h6>
                            @foreach(['hotel', 'guesthouse', 'resort', 'cottage', 'inn', 'homestay'] as $type)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="property_types[]" value="{{ $type }}" id="type_{{ $type }}" {{ in_array($type, $filters['property_types'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_{{ $type }}">{{ ucfirst($type) }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Price Range --}}
                        <div class="filter-section">
                            <h6 class="filter-title">Price Range (per night)</h6>
                            <div class="price-inputs">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" class="form-control" name="min_price" value="{{ $filters['min_price'] ?? '' }}" placeholder="0">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" class="form-control" name="max_price" value="{{ $filters['max_price'] ?? '' }}" placeholder="Any">
                                </div>
                            </div>
                        </div>

                        {{-- Star Rating --}}
                        <div class="filter-section">
                            <h6 class="filter-title">Star Rating</h6>
                            @for($i = 5; $i >= 3; $i--)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="star_ratings[]" value="{{ $i }}" id="star_{{ $i }}" {{ in_array($i, $filters['star_ratings'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="star_{{ $i }}">{{ str_repeat('⭐', $i) }}</label>
                            </div>
                            @endfor
                        </div>

                        {{-- Amenities --}}
                        <div class="filter-section">
                            <h6 class="filter-title">Amenities</h6>
                            @foreach(['WiFi', 'Parking', 'Restaurant', 'AC', 'Swimming Pool', 'Spa', 'Gym'] as $facility)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $facility }}" id="facility_{{ Str::slug($facility) }}" {{ in_array($facility, $filters['facilities'] ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="facility_{{ Str::slug($facility) }}">{{ $facility }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Special Offers --}}
                        <div class="filter-section">
                            <h6 class="filter-title">Special Offers</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="free_cancellation" value="1" id="free_cancellation" {{ isset($filters['free_cancellation']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="free_cancellation">Free Cancellation</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Clear All</a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- RIGHT: Accommodations List --}}
            <div class="accommodations-column">
                <div class="accommodations-list">
                    @forelse($accommodations as $accommodation)
                    <div class="accommodation-card">
                        {{-- Image Section --}}
                        <div class="card-image">
                            <img src="{{ $accommodation->image_url }}" alt="{{ $accommodation->name }}">
                            <span class="badge">{{ ucfirst($accommodation->type) }}</span>
                        </div>

                        {{-- Details Section --}}
                        <div class="card-details">
                            <h5 class="card-title">{{ $accommodation->name }}</h5>

                            <div class="rating">
                                <span class="stars">{{ $accommodation->getStarRatingHtml() }}</span>
                                <span class="text-muted">({{ $accommodation->reviews_count }} reviews)</span>
                                <span class="badge">{{ $accommodation->rating }} {{ $accommodation->getRatingCategory() }}</span>
                            </div>

                            @if($accommodation->distance_from_attraction)
                            <p class="distance mb-2">
                                <a href="{{ $accommodation->getMapUrl() }}" target="_blank">
                                    <i class="fas fa-map-marker-alt"></i> {{ number_format($accommodation->distance_from_attraction, 1) }} km from {{ $attraction->name }}
                                </a>
                            </p>
                            @endif

                            <p class="address"><i class="fas fa-location-dot"></i> {{ Str::limit($accommodation->address, 80) }}</p>
                            <p class="card-text">{{ Str::limit($accommodation->description, 120) }}</p>

                            @if($accommodation->facilities)
                            <div class="facilities mt-2">
                                @foreach(array_slice($accommodation->facilities, 0, 6) as $facility)
                                <span class="badge"><i class="fas fa-check-circle text-success"></i> {{ $facility }}</span>
                                @endforeach
                            </div>
                            @endif

                            @if($accommodation->tags)
                            <div class="tags mt-2">
                                @foreach(array_slice($accommodation->tags, 0, 3) as $tag)
                                <span class="badge">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        {{-- Price Section --}}
                        <div class="card-price">
                            <div>
                                <div class="distance-badge">
                                    @if($accommodation->distance_from_attraction <= 1)
                                    <span class="badge bg-success"><i class="fas fa-walking"></i> {{ number_format($accommodation->distance_from_attraction, 1) }} km</span>
                                    <small>5-min drive</small>
                                    @else
                                    <span class="badge bg-info"><i class="fas fa-car"></i> {{ number_format($accommodation->distance_from_attraction, 1) }} km</span>
                                    <small>{{ round($accommodation->distance_from_attraction * 3) }}-min drive</small>
                                    @endif
                                </div>

                                <div class="text-center mt-2">
                                    <small class="d-block">Starting from</small>
                                    <h4 class="price">Rs. {{ number_format($accommodation->price_per_night, 0) }}</h4>
                                    <small>per night<br>+ taxes & fees</small>
                                </div>

                                @if($accommodation->hasAvailability())
                                <div class="availability">
                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> Available</span>
                                </div>
                                @else
                                <div class="availability">
                                    <span class="badge bg-danger">Fully Booked</span>
                                </div>
                                @endif
                            </div>

                            <div>
                                <a href="#" class="btn btn-primary">View Details</a>
                                <a href="#" class="btn btn-outline-primary">Check Availability</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No accommodations found matching your criteria. Try adjusting your filters.
                    </div>
                    @endforelse

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $accommodations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const distanceRange = document.getElementById('distanceRange');
const distanceValue = document.getElementById('distanceValue');
if (distanceRange && distanceValue) {
    distanceRange.addEventListener('input', function() {
        distanceValue.textContent = `Within ${this.value} km`;
    });
}
</script>
@endsection
