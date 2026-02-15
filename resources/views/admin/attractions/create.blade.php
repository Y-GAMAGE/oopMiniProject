
{{-- filepath: resources/views/admin/attractions/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Add New Attraction')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333; margin-bottom: 30px;">Add New Attraction</h1>

    <form action="{{ route('admin.attractions.store') }}" method="POST" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">District *</label>
                <select name="district_id" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                    <option value="">Select District</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                            {{ $district->name }} ({{ $district->country->name }})
                        </option>
                    @endforeach
                </select>
                @error('district_id')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Category *</label>
                <select name="category_id" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->icon }} {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Attraction Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                   placeholder="e.g., Temple of the Sacred Tooth Relic">
            @error('name')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Description *</label>
            <textarea name="description" rows="6" required
                      style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">{{ old('description') }}</textarea>
            @error('description')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Location *</label>
            <input type="text" name="location" value="{{ old('location') }}"
                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                   placeholder="e.g., Sri Dalada Veediya, Kandy">
            @error('location')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Latitude</label>
                <input type="number" step="0.0000001" name="latitude" value="{{ old('latitude') }}"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       placeholder="e.g., 7.2906">
                @error('latitude')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Longitude</label>
                <input type="number" step="0.0000001" name="longitude" value="{{ old('longitude') }}"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       placeholder="e.g., 80.6337">
                @error('longitude')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Entry Fee (Rs)</label>
                <input type="number" step="0.01" name="entry_fee" value="{{ old('entry_fee') }}"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       placeholder="Leave empty for free entry">
                @error('entry_fee')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Opening Time</label>
                <input type="time" name="opening_time" value="{{ old('opening_time') }}"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                @error('opening_time')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Closing Time</label>
                <input type="time" name="closing_time" value="{{ old('closing_time') }}"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                @error('closing_time')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Rating (0-5)</label>
                <input type="number" step="0.1" min="0" max="5" name="rating" value="{{ old('rating', 4.5) }}"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                @error('rating')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Image URL</label>
                <input type="url" name="image_url" value="{{ old('image_url') }}"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       placeholder="https://example.com/image.jpg">
                @error('image_url')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 30px;">
            <button type="submit" style="flex: 1; background: #667eea; color: white; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; cursor: pointer;">
                Create Attraction
            </button>
            <a href="{{ route('admin.attractions') }}" style="flex: 1; background: #e0e0e0; color: #333; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; text-align: center; text-decoration: none; display: block;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
