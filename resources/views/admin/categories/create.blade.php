
{{-- filepath: resources/views/admin/categories/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Add New Category')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333; margin-bottom: 30px;">Add New Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Category Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                   placeholder="e.g., Temples & Religious Sites">
            @error('name')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Description</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                      placeholder="Brief description of this category">{{ old('description') }}</textarea>
            @error('description')
                <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Icon (Emoji)</label>
                <input type="text" name="icon" value="{{ old('icon') }}" maxlength="10"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       placeholder="e.g., 🛕">
                <small style="color: #999; font-size: 12px;">Use emoji picker or paste emoji</small>
                @error('icon')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Color (Hex)</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="color" name="color" value="{{ old('color', '#667eea') }}"
                           style="width: 60px; height: 45px; border: 2px solid #e0e0e0; border-radius: 8px; cursor: pointer;">
                    <input type="text" name="color_text" value="{{ old('color', '#667eea') }}"
                           style="flex: 1; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                           placeholder="#667eea">
                </div>
                @error('color')
                    <span style="color: #f56565; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h4 style="margin-bottom: 15px; color: #333;">Preview</h4>
            <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px;">
                <div id="preview-icon" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-size: 28px; background: #667eea; border-radius: 12px; color: white;">
                    🛕
                </div>
                <div>
                    <div id="preview-name" style="font-weight: 600; font-size: 16px; color: #333;">Category Name</div>
                    <div id="preview-desc" style="font-size: 13px; color: #999;">Category description</div>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 30px;">
            <button type="submit" style="flex: 1; background: #667eea; color: white; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; cursor: pointer;">
                Create Category
            </button>
            <a href="{{ route('admin.categories') }}" style="flex: 1; background: #e0e0e0; color: #333; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; text-align: center; text-decoration: none; display: block;">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="name"]');
    const descInput = document.querySelector('textarea[name="description"]');
    const iconInput = document.querySelector('input[name="icon"]');
    const colorInput = document.querySelector('input[name="color"]');
    const colorTextInput = document.querySelector('input[name="color_text"]');

    nameInput?.addEventListener('input', (e) => {
        document.getElementById('preview-name').textContent = e.target.value || 'Category Name';
    });

    descInput?.addEventListener('input', (e) => {
        document.getElementById('preview-desc').textContent = e.target.value || 'Category description';
    });

    iconInput?.addEventListener('input', (e) => {
        document.getElementById('preview-icon').textContent = e.target.value || '🛕';
    });

    colorInput?.addEventListener('input', (e) => {
        document.getElementById('preview-icon').style.background = e.target.value;
        colorTextInput.value = e.target.value;
    });

    colorTextInput?.addEventListener('input', (e) => {
        document.getElementById('preview-icon').style.background = e.target.value;
        colorInput.value = e.target.value;
    });
});
</script>
@endsection
