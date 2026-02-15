<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelEase Admin - @yield('title', 'Dashboard')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        /* Top Navigation */
        .top-nav {
            background: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-logo {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .admin-badge {
            background: #667eea;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .nav-search {
            flex: 0 0 400px;
        }

        .nav-search input {
            width: 100%;
            padding: 10px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 14px;
        }

        .nav-right {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
            font-size: 20px;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-dropdown {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
            min-width: 150px;
            overflow: hidden;
        }

        .user-dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu form button {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: #333;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: 14px;
        }

        .dropdown-menu a:hover,
        .dropdown-menu form button:hover {
            background: #f5f7fa;
        }

        /* Main Container */
        .admin-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: calc(100vh - 70px);
        }

        /* Sidebar */
        .sidebar {
            background: white;
            padding: 30px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar-section {
            margin-bottom: 30px;
        }

        .sidebar-title {
            padding: 0 25px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            text-decoration: none;
            color: #666;
            transition: all 0.3s;
            font-size: 14px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #f5f7fa;
            color: #667eea;
            border-left: 3px solid #667eea;
        }

        .sidebar-menu .icon {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            padding: 30px;
            overflow-x: hidden;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            gap: 15px;
            position: relative;
            overflow: hidden;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-content h3 {
            font-size: 13px;
            color: #999;
            font-weight: 500;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .stat-growth {
            font-size: 13px;
            color: #48bb78;
        }

        .stat-growth.negative {
            color: #f56565;
        }

        .stat-chart {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 120px;
            height: 40px;
            opacity: 0.3;
        }

        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-btn {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }

        .btn-info {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        }

        .action-btn .icon {
            font-size: 28px;
        }

        .action-btn .text {
            font-weight: 500;
        }

        /* Charts Row */
        .charts-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h3 {
            font-size: 18px;
            color: #333;
        }

        .chart-period {
            padding: 6px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 13px;
        }

        canvas {
            max-height: 300px;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .dashboard-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h3 {
            font-size: 16px;
            color: #333;
        }

        .view-all {
            color: #667eea;
            text-decoration: none;
            font-size: 13px;
        }

        /* Activity List */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            gap: 15px;
            padding: 12px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .activity-icon {
            font-size: 20px;
        }

        .activity-content p {
            margin: 0;
            color: #333;
            font-size: 14px;
        }

        .activity-time {
            font-size: 12px;
            color: #999;
        }

        /* List Items */
        .list-items {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .item-name {
            font-size: 14px;
            color: #333;
        }

        .item-badge {
            padding: 4px 12px;
            background: #e0e0e0;
            border-radius: 12px;
            font-size: 12px;
        }

        .item-badge.green {
            background: #c6f6d5;
            color: #22543d;
        }

        .item-rating {
            color: #f6ad55;
            font-weight: 500;
        }

        /* Table Styles */
        .admin-table {
            width: 100%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .admin-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th,
        .admin-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .admin-table th {
            background: #f9f9f9;
            font-weight: 600;
            color: #333;
            font-size: 13px;
        }

        .action-buttons-cell {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #4299e1;
            color: white;
        }

        .btn-edit:hover {
            background: #3182ce;
        }

        .btn-delete {
            background: #f56565;
            color: white;
        }

        .btn-delete:hover {
            background: #e53e3e;
        }

        .btn-add {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #667eea;
            color: white;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-add:hover {
            transform: scale(1.1);
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .admin-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .charts-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    {{-- Top Navigation --}}
    <div class="top-nav">
        <div class="nav-brand">
            <a href="{{ route('admin.dashboard') }}" class="brand-logo">TravelEase</a>
            <span class="admin-badge">Admin Panel</span>
        </div>

        <div class="nav-search">
            <input type="text" placeholder="Search across all content...">
        </div>

        <div class="nav-right">
            <div class="notification-icon">
                🔔
                <span class="notification-badge">3</span>
            </div>

            <div class="user-dropdown">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=667eea&color=fff" alt="Admin" class="user-avatar">
                <div class="dropdown-menu">
                    <a href="{{ route('user.dashboard') }}">User Dashboard</a>
                    <a href="{{ route('admin.settings') }}">Settings</a>
                    <hr style="margin: 5px 0; border: none; border-top: 1px solid #e0e0e0;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-container">
        {{-- Sidebar --}}
        <div class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-title">Content Management</div>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="icon">📊</span> Overview
                    </a></li>
                    <li><a href="{{ route('admin.countries') }}" class="{{ request()->routeIs('admin.countries*') ? 'active' : '' }}">
                        <span class="icon">🌐</span> Countries
                    </a></li>
                    <li><a href="{{ route('admin.districts') }}" class="{{ request()->routeIs('admin.districts*') ? 'active' : '' }}">
                        <span class="icon">📍</span> Districts
                    </a></li>
                    <li><a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                        <span class="icon">🏷️</span> Categories
                    </a></li>
                    <li><a href="{{ route('admin.attractions') }}" class="{{ request()->routeIs('admin.attractions*') ? 'active' : '' }}">
                        <span class="icon">🎯</span> Attractions
                    </a></li>
                    <li><a href="{{ route('admin.accommodations') }}" class="{{ request()->routeIs('admin.accommodations*') ? 'active' : '' }}">
                        <span class="icon">🏨</span> Accommodations
                    </a></li>
                    <li><a href="{{ route('admin.restaurants') }}" class="{{ request()->routeIs('admin.restaurants*') ? 'active' : '' }}">
                        <span class="icon">🍽️</span> Restaurants
                    </a></li>
                </ul>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-title">System</div>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <span class="icon">👥</span> Users
                    </a></li>
                    <li><a href="{{ route('admin.reviews') }}" class="{{ request()->routeIs('admin.reviews*') ? 'active' : '' }}">
                        <span class="icon">⭐</span> Reviews
                    </a></li>
                    <li><a href="{{ route('admin.analytics') }}" class="{{ request()->routeIs('admin.analytics*') ? 'active' : '' }}">
                        <span class="icon">📈</span> Analytics
                    </a></li>
                    <li><a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                        <span class="icon">⚙️</span> Settings
                    </a></li>
                </ul>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="main-content">
            @if(session('success'))
            <div class="alert alert-success" style="padding: 15px; background: #c6f6d5; color: #22543d; border-radius: 8px; margin-bottom: 20px;">
                ✓ {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error" style="padding: 15px; background: #fed7d7; color: #742a2a; border-radius: 8px; margin-bottom: 20px;">
                ✗ {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>
{{-- filepath: resources/views/admin/categories/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333;">Manage Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn" style="background: #667eea; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none;">
        ➕ Add New Category
    </a>
</div>

<div class="admin-table">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Icon</th>
                <th>Color</th>
                <th>Attractions Count</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>
                    <strong>{{ $category->name }}</strong><br>
                    <small style="color: #999;">{{ $category->slug }}</small>
                </td>
                <td style="font-size: 24px;">{{ $category->icon ?? '📍' }}</td>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 30px; height: 30px; background: {{ $category->color ?? '#667eea' }}; border-radius: 6px;"></div>
                        <span>{{ $category->color ?? 'Not set' }}</span>
                    </div>
                </td>
                <td>{{ $category->attractions_count }} attractions</td>
                <td>{{ $category->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="action-buttons-cell">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px;">No categories found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $categories->links(pagination::simple-default) }}
</div>
@endsection
