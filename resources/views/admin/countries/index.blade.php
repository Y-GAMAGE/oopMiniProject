
{{-- filepath: resources/views/admin/countries/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Manage Countries')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333;">Manage Countries</h1>
    <a href="{{ route('admin.countries.create') }}" class="btn" style="background: #667eea; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none;">
        ➕ Add New Country
    </a>
</div>

<div class="admin-table">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Continent</th>
                <th>Districts</th>
                <th>Languages</th>
                <th>Currency</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($countries as $country)
            <tr>
                <td>
                    <strong>{{ $country->name }}</strong><br>
                    <small style="color: #999;">{{ $country->tagline }}</small>
                </td>
                <td>{{ $country->continent }}</td>
                <td>{{ $country->districts_count }}</td>
                <td>{{ $country->languages }}</td>
                <td>{{ $country->currency }}</td>
                <td>{{ $country->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="action-buttons-cell">
                        <a href="{{ route('admin.countries.edit', $country->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.countries.delete', $country->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px;">No countries found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $countries->links('pagination::simple-default') }}
</div>
@endsection
