
{{-- filepath: resources/views/admin/categories/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333; margin-bottom: 30px;">Edit Category: {{ $category->name }}</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Category Name *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                   style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Description</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">{{ old('description', $category->description) }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Icon (Emoji)</label>
                <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" maxlength="10"
                       style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Color (Hex)</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="color" name="color" value="{{ old('color', $category->color ?? '#667eea') }}"
                           style="width: 60px; height: 45px; border: 2px solid #e0e0e0; border-radius: 8px; cursor: pointer;">
                    <input type="text" name="color_text" value="{{ old('color', $category->color ?? '#667eea') }}"
                           style="flex: 1; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px;">
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 30px;">
            <button type="submit" style="flex: 1; background: #667eea; color: white; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; cursor: pointer;">
                Update Category
            </button>
            <a href="{{ route('admin.categories') }}" style="flex: 1; background: #e0e0e0; color: #333; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; text-align: center; text-decoration: none; display: block;">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorInput = document.querySelector('input[name="color"]');
    const colorTextInput = document.querySelector('input[name="color_text"]');

    colorInput?.addEventListener('input', (e) => {
        colorTextInput.value = e.target.value;
    });

    colorTextInput?.addEventListener('input', (e) => {
        colorInput.value = e.target.value;
    });
});
</script>
@endsection
