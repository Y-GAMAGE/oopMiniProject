
{{-- filepath: resources/views/admin/users/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333;">User Management</h1>
</div>

<div class="admin-table">
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Registered</th>
                <th>Last Login</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=667eea&color=fff"
                             alt="{{ $user->name }}"
                             style="width: 40px; height: 40px; border-radius: 50%;">
                        <div>
                            <strong>{{ $user->name }}</strong>
                        </div>
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->is_admin)
                        <span style="padding: 4px 12px; background: #764ba2; color: white; border-radius: 12px; font-size: 12px;">
                            👑 Admin
                        </span>
                    @else
                        <span style="padding: 4px 12px; background: #e0e0e0; color: #333; border-radius: 12px; font-size: 12px;">
                            👤 User
                        </span>
                    @endif
                </td>
                <td>
                    @if($user->email_verified_at)
                        <span style="padding: 4px 12px; background: #c6f6d5; color: #22543d; border-radius: 12px; font-size: 12px;">
                            ✓ Verified
                        </span>
                    @else
                        <span style="padding: 4px 12px; background: #feebc8; color: #7c2d12; border-radius: 12px; font-size: 12px;">
                            ⚠ Unverified
                        </span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</td>
                <td>
                    <div class="action-buttons-cell">
                        <button class="btn btn-edit" onclick="alert('User edit functionality coming soon')">Edit</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px;">No users found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $users->links() }}
</div>
@endsection
