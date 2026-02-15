<?php
{{-- filepath: resources/views/admin/accommodations/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Add New Accommodation')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333; margin-bottom: 30px;">Add New Accommodation</h1>

    <form action="{{ route('admin.accommodations.store') }}" method="POST" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        @csrf

        <div style="margin-bottom: 20px;">
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

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Accommodation Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                   placeholder="e.g., Earl's Regency Hotel">
            @error('name')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Type *</label>
                <select name="type" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                    <option value="">Select Type</option>
                    <option value="hotel" {{ old('type') == 'hotel' ? 'selected' : '' }}>🏨 Hotel</option>
                    <option value="guesthouse" {{ old('type') == 'guesthouse' ? 'selected' : '' }}>🏡 Guesthouse</option>
                    <option value="resort" {{ old('type') == 'resort' ? 'selected' : '' }}>🏖️ Resort</option>
                    <option value="inn" {{ old('type') == 'inn' ? 'selected' : '' }}>🏠 Inn</option>
                    <option value="cottage" {{ old('type') == 'cottage' ? 'selected' : '' }}>🛖 Cottage</option>
                    <option value="homestay" {{ old('type') == 'homestay' ? 'selected' : '' }}>🏘️ Homestay</option>
                </select>
                @error('type')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Price Per Night (Rs) *</label>
                <input type="number" step="0.01" name="price_per_night" value="{{ old('price_per_night') }}" required
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       placeholder="e.g., 15000">
                @error('price_per_night')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Description *</label>
            <textarea name="description" rows="5" required
                      style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">{{ old('description') }}</textarea>
            @error('description')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Total Rooms *</label>
                <input type="number" name="total_rooms" value="{{ old('total_rooms') }}" required min="1"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       placeholder="e.g., 50">
                @error('total_rooms')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Available Rooms *</label>
                <input type="number" name="available_rooms" value="{{ old('available_rooms') }}" required min="0"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       placeholder="e.g., 35">
                @error('available_rooms')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Address/Location</label>
            <input type="text" name="location" value="{{ old('location') }}"
                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                   placeholder="e.g., Temple Street, Kandy">
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
                Create Accommodation
            </button>
            <a href="{{ route('admin.accommodations') }}" style="flex: 1; background: #e0e0e0; color: #333; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; text-align: center; text-decoration: none; display: block;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
