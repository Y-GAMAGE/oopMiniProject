@extends('user.layouts.app')

@section('title', 'Saved Places - TravelEase')

@section('content')
<div style="margin-bottom: 30px;">
    <h1 style="font-size: 32px; font-weight: 700; color: #1e3a8a; margin-bottom: 16px;">Your Saved Places</h1>
    <p style="color: #6b7280; font-size: 16px;">{{ $savedPlaces->total() }} places saved</p>
</div>

<!-- Filter Tabs -->
<div style="display: flex; gap: 12px; margin-bottom: 30px; flex-wrap: wrap;">
    <a href="{{ route('user.saved') }}"
       class="filter-tab {{ $type === 'all' ? 'active' : '' }}"
       style="padding: 10px 20px; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s; {{ $type === 'all' ? 'background: #1e3a8a; color: white;' : 'background: #f3f4f6; color: #6b7280;' }}">
        All Places
    </a>
    <a href="{{ route('user.saved', ['type' => 'attraction']) }}"
       class="filter-tab {{ $type === 'attraction' ? 'active' : '' }}"
       style="padding: 10px 20px; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s; {{ $type === 'attraction' ? 'background: #1e3a8a; color: white;' : 'background: #f3f4f6; color: #6b7280;' }}">
        Attractions
    </a>
    <a href="{{ route('user.saved', ['type' => 'accommodation']) }}"
       class="filter-tab {{ $type === 'accommodation' ? 'active' : '' }}"
       style="padding: 10px 20px; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s; {{ $type === 'accommodation' ? 'background: #1e3a8a; color: white;' : 'background: #f3f4f6; color: #6b7280;' }}">
        Hotels
    </a>
    <a href="{{ route('user.saved', ['type' => 'restaurant']) }}"
       class="filter-tab {{ $type === 'restaurant' ? 'active' : '' }}"
       style="padding: 10px 20px; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s; {{ $type === 'restaurant' ? 'background: #1e3a8a; color: white;' : 'background: #f3f4f6; color: #6b7280;' }}">
        Restaurants
    </a>
</div>

<!-- Saved Places Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 24px;">
    @forelse($savedPlaces as $saved)
        @php
            $place = $saved->saveable;
        @endphp
        @if($place)
        <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08); transition: all 0.3s;">
            <div style="position: relative;">
                <img src="{{ $place->image_url ?? 'https://via.placeholder.com/400x250' }}"
                     alt="{{ $place->name }}"
                     style="width: 100%; height: 200px; object-fit: cover;">
                <div style="position: absolute; top: 12px; right: 12px; background: rgba(0, 0, 0, 0.7); color: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                    {{ class_basename($saved->saveable_type) }}
                </div>
            </div>

            <div style="padding: 20px;">
                <h3 style="font-size: 18px; font-weight: 700; color: #1e3a8a; margin-bottom: 8px;">{{ $place->name }}</h3>

                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; font-size: 14px; color: #6b7280;">
                    <span>📍</span>
                    <span>{{ $place->location ?? $place->address ?? 'Location N/A' }}</span>
                </div>

                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; font-size: 14px;">
                    <span style="color: #f59e0b; font-weight: 600;">⭐ {{ number_format($place->rating ?? 0, 1) }}</span>
                </div>

                <div style="display: flex; gap: 10px;">
                    <a href="{{
                        class_basename($saved->saveable_type) === 'Attraction'
                            ? route('attractions.show', [
                                $place->district->country->slug,
                                $place->district->slug,
                                $place->category->slug,
                                $place->slug
                            ])
                            : '#'
                    }}" style="flex: 1; padding: 10px; background: #1e3a8a; color: white; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">
                        View Details
                    </a>

                    <form action="{{ route('saved.destroy', $saved->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Remove from saved places?')"
                                style="width: 100%; padding: 10px; background: white; color: #dc2626; border: 2px solid #dc2626; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px;">
                            Remove
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
            <div style="font-size: 64px; margin-bottom: 20px;">🤍</div>
            <h3 style="font-size: 24px; color: #1e3a8a; margin-bottom: 12px;">No saved places yet</h3>
            <p style="color: #6b7280; margin-bottom: 24px;">Start exploring and save your favorite places!</p>
            <a href="{{ route('countries.index') }}" style="display: inline-block; padding: 12px 24px; background: #1e3a8a; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Explore Destinations
            </a>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div style="margin-top: 40px;">
    {{ $savedPlaces->links() }}
</div>
@endsection
