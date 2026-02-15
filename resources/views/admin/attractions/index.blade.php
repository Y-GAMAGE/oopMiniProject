
{{-- filepath: resources/views/admin/attractions/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Manage Attractions')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333;">Manage Attractions</h1>
    <a href="{{ route('admin.attractions.create') }}" class="btn" style="background: #667eea; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none;">
        ➕ Add New Attraction
    </a>
</div>

<div class="admin-table">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Category</th>
                <th>Rating</th>
                <th>Entry Fee</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attractions as $attraction)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <img src="{{ $attraction->image_url ?? 'https://via.placeholder.com/60' }}"
                             alt="{{ $attraction->name }}"
                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                        <div>
                            <strong>{{ $attraction->name }}</strong><br>
                            <small style="color: #999;">{{ Str::limit($attraction->location, 30) }}</small>
                        </div>
                    </div>
                </td>
                <td>{{ $attraction->district->name }}</td>
                <td>
                    <span style="padding: 4px 12px; background: {{ $attraction->category->color ?? '#e0e0e0' }}; color: white; border-radius: 12px; font-size: 12px;">
                        {{ $attraction->category->icon }} {{ $attraction->category->name }}
                    </span>
                </td>
                <td>
                    <div style="display: flex; align-items: center; gap: 5px;">
                        <span style="color: #f6ad55;">⭐</span>
                        <strong>{{ number_format($attraction->rating, 1) }}</strong>
                        <small style="color: #999;">({{ $attraction->reviews_count }})</small>
                    </div>
                </td>
                <td>
                    @if($attraction->entry_fee)
                        Rs. {{ number_format($attraction->entry_fee) }}
                    @else
                        <span style="color: #48bb78; font-weight: 500;">Free</span>
                    @endif
                </td>
                <td>
                    @if($attraction->is_open_now)
                        <span style="padding: 4px 12px; background: #c6f6d5; color: #22543d; border-radius: 12px; font-size: 12px;">
                            🟢 Open
                        </span>
                    @else
                        <span style="padding: 4px 12px; background: #fed7d7; color: #742a2a; border-radius: 12px; font-size: 12px;">
                            🔴 Closed
                        </span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons-cell">
                        <a href="{{ route('admin.attractions.edit', $attraction->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.attractions.delete', $attraction->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px;">No attractions found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $attractions->links('pagination::simple-default') }}
</div>
@endsection
