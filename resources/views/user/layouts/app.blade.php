<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'User Dashboard') - TravelEase</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #1f2937;
        }

        /* Top Navigation */
        .top-nav {
            background: white;
            padding: 16px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            font-size: 24px;
            font-weight: 700;
            color: #1e3a8a;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #6b7280;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #1e3a8a;
        }

        .user-menu {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #e5e7eb;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 12px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            overflow: hidden;
        }

        .user-menu:hover .dropdown {
            display: block;
        }

        .dropdown a,
        .dropdown form button {
            display: block;
            width: 100%;
            padding: 12px 20px;
            text-decoration: none;
            color: #1f2937;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            transition: background 0.2s;
        }

        .dropdown a:hover,
        .dropdown form button:hover {
            background: #f3f4f6;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        /* Sidebar Layout */
        .dashboard-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 32px;
        }

        /* Sidebar */
        .sidebar {
            background: white;
            border-radius: 16px;
            padding: 24px;
            height: fit-content;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 100px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: #6b7280;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #dbeafe;
            color: #1e3a8a;
        }

        .sidebar-menu .icon {
            font-size: 20px;
        }

        /* Main Content */
        .main-content {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            min-height: 600px;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e3a8a;
            border: 1px solid #bfdbfe;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: relative;
                top: 0;
            }

            .nav-menu {
                gap: 16px;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .container {
                padding: 20px 16px;
            }

            .main-content {
                padding: 20px;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-brand">TravelEase</a>

            <div class="nav-menu">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('countries.index') }}" class="nav-link">Destinations</a>
                <a href="{{ route('search') }}" class="nav-link">Search</a>

                <div class="user-menu">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=1e3a8a&color=fff"
                         alt="{{ auth()->user()->name }}"
                         class="user-avatar">

                    <div class="dropdown">
                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                        <a href="{{ route('user.profile') }}">Profile</a>
                        <a href="{{ route('user.settings') }}">Settings</a>
                        <hr style="margin: 8px 0; border: none; border-top: 1px solid #e5e7eb;">
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="dashboard-layout">
            <!-- Sidebar -->
            <aside class="sidebar">
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <span class="icon">📊</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.trips') }}" class="{{ request()->routeIs('user.trips') ? 'active' : '' }}">
                            <span class="icon">✈️</span>
                            <span>My Trips</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.saved') }}" class="{{ request()->routeIs('user.saved') ? 'active' : '' }}">
                            <span class="icon">❤️</span>
                            <span>Saved Places</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.reviews') }}" class="{{ request()->routeIs('user.reviews') ? 'active' : '' }}">
                            <span class="icon">⭐</span>
                            <span>My Reviews</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.profile') }}" class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                            <span class="icon">👤</span>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.settings') }}" class="{{ request()->routeIs('user.settings') ? 'active' : '' }}">
                            <span class="icon">⚙️</span>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <span>✓</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <span>✗</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info">
                        <span>ℹ</span>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
