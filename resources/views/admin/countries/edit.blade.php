
{{-- filepath: resources/views/admin/countries/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Country')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333; margin-bottom: 30px;">Edit Country: {{ $country->name }}</h1>

    <form action="{{ route('admin.countries.update', $country->id) }}" method="POST" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Country Name *</label>
            <input type="text" name="name" value="{{ old('name', $country->name) }}" required
                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
            @error('name')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Tagline *</label>
            <input type="text" name="tagline" value="{{ old('tagline', $country->tagline) }}" required
                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
            @error('tagline')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Description *</label>
            <textarea name="description" rows="6" required
                      style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">{{ old('description', $country->description) }}</textarea>
            @error('description')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Continent *</label>
                <select name="continent" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                    <option value="">Select Continent</option>
                    <option value="Asia" {{ old('continent', $country->continent) == 'Asia' ? 'selected' : '' }}>Asia</option>
                    <option value="Europe" {{ old('continent', $country->continent) == 'Europe' ? 'selected' : '' }}>Europe</option>
                    <option value="Africa" {{ old('continent', $country->continent) == 'Africa' ? 'selected' : '' }}>Africa</option>
                    <option value="North America" {{ old('continent', $country->continent) == 'North America' ? 'selected' : '' }}>North America</option>
                    <option value="South America" {{ old('continent', $country->continent) == 'South America' ? 'selected' : '' }}>South America</option>
                    <option value="Oceania" {{ old('continent', $country->continent) == 'Oceania' ? 'selected' : '' }}>Oceania</option>
                </select>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Languages *</label>
                <input type="text" name="languages" value="{{ old('languages', $country->languages) }}" required
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Currency *</label>
                <input type="text" name="currency" value="{{ old('currency', $country->currency) }}" required
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Image URL</label>
                <input type="url" name="image_url" value="{{ old('image_url', $country->image_url) }}"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
            </div>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 30px;">
            <button type="submit" style="flex: 1; background: #667eea; color: white; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; cursor: pointer;">
                Update Country
            </button>
            <a href="{{ route('admin.countries') }}" style="flex: 1; background: #e0e0e0; color: #333; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; text-align: center; text-decoration: none; display: block;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
