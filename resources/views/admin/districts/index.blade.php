{{-- filepath: resources/views/admin/districts/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Manage Districts')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333;">Manage Districts</h1>
    <a href="{{ route('admin.districts.create') }}" class="btn" style="background: #667eea; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 14px;">
        + Add New District
    </a>
</div>

<div class="admin-table">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th>Region</th>
                <th>Best Season</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($districts as $district)
            <tr>
                <td>
                    <strong>{{ $district->name }}</strong>
                </td>
                <td>{{ $district->country->name }}</td>
                <td>{{ $district->region }}</td>
                <td>{{ $district->best_season ?? 'Year-round' }}</td>
                <td>{{ $district->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="action-buttons-cell">
                        <a href="{{ route('admin.districts.edit', $district->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.districts.delete', $district->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px;">No districts found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $districts->links(pagination::simple-default) }}
</div>
@endsection
