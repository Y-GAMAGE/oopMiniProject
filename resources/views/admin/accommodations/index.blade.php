
{{-- filepath: resources/views/admin/accommodations/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Manage Accommodations')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333;">Manage Accommodations</h1>
    <a href="{{ route('admin.accommodations.create') }}" class="btn" style="background: #667eea; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none;">
        ➕ Add New Accommodation
    </a>
</div>

<div class="admin-table">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Type</th>
                <th>Price/Night</th>
                <th>Rooms</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($accommodations as $accommodation)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <img src="{{ $accommodation->image_url ?? 'https://via.placeholder.com/60' }}"
                             alt="{{ $accommodation->name }}"
                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                        <div>
                            <strong>{{ $accommodation->name }}</strong><br>
                            <small style="color: #999;">{{ Str::limit($accommodation->location, 30) }}</small>
                        </div>
                    </div>
                </td>
                <td>{{ $accommodation->district->name }}</td>
                <td>
                    <span style="padding: 4px 12px; background: #e0e0e0; border-radius: 12px; font-size: 12px; text-transform: capitalize;">
                        {{ $accommodation->type }}
                    </span>
                </td>
                <td>
                    <strong style="color: #667eea;">Rs. {{ number_format($accommodation->price_per_night) }}</strong>
                </td>
                <td>
                    <div style="font-size: 13px;">
                        <strong>{{ $accommodation->available_rooms }}</strong> / {{ $accommodation->total_rooms }}
                        <br>
                        <small style="color: {{ $accommodation->available_rooms > 0 ? '#48bb78' : '#f56565' }};">
                            {{ $accommodation->available_rooms > 0 ? 'Available' : 'Full' }}
                        </small>
                    </div>
                </td>
                <td>
                    <div style="display: flex; align-items: center; gap: 5px;">
                        <span style="color: #f6ad55;">⭐</span>
                        <strong>{{ number_format($accommodation->rating, 1) }}</strong>
                    </div>
                </td>
                <td>
                    @if($accommodation->is_active)
                        <span style="padding: 4px 12px; background: #c6f6d5; color: #22543d; border-radius: 12px; font-size: 12px;">
                            ✓ Active
                        </span>
                    @else
                        <span style="padding: 4px 12px; background: #fed7d7; color: #742a2a; border-radius: 12px; font-size: 12px;">
                            ✗ Inactive
                        </span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons-cell">
                        <a href="{{ route('admin.accommodations.edit', $accommodation->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.accommodations.delete', $accommodation->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 40px;">No accommodations found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $accommodations->links() }}
</div>
@endsection
