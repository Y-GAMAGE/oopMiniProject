<!-- filepath: resources/views/topnav.blade.php -->
<nav class="topnav" id="mainNav">
    <div class="nav-container">
        <!-- Left Side: Logo -->
        <div class="nav-left">
            <a href="{{ route('home') }}" class="logo-link">
                <svg class="logo-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
                </svg>
                <span class="logo-text">TravelEase</span>
            </a>
        </div>

        <!-- Center: Main Menu -->
        <div class="nav-center" id="navMenu">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('countries.index') }}" class="nav-link {{ request()->routeIs('countries.*') ? 'active' : '' }}">
                        Countries
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#about" class="nav-link">
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link">
                        Contact
                    </a>
                </li>
            </ul>
        </div>

        <!-- Right Side: Actions -->
        <div class="nav-right">
            <!-- Search Button -->
            <button class="icon-btn search-btn" id="searchBtn" aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M9 17A8 8 0 1 0 9 1a8 8 0 0 0 0 16zM19 19l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

      <!-- Only show Login button for guests -->
    @guest
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    @else
        <!-- Logged in users only see logout -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-outline">Logout</button>
        </form>
    @endguest

            <!-- Mobile Menu Toggle -->
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>

<!-- Search Modal -->
<div class="search-modal" id="searchModal">
    <div class="search-modal-content">
        <button class="search-close" id="searchClose">&times;</button>
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="text" name="q" placeholder="Search destinations, attractions..." class="search-input" autofocus>
            <button type="submit" class="search-submit">
                <svg width="24" height="24" viewBox="0 0 20 20" fill="none">
                    <path d="M9 17A8 8 0 1 0 9 1a8 8 0 0 0 0 16zM19 19l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>
        <div class="search-suggestions">
            <h4>Popular Searches</h4>
            <div class="suggestion-tags">
                <a href="{{ route('search') }}?q=beaches">Beaches</a>
                <a href="{{ route('search') }}?q=mountains">Mountains</a>
                <a href="{{ route('search') }}?q=historical">Historical Sites</a>
                <a href="{{ route('search') }}?q=wildlife">Wildlife</a>
            </div>
        </div>
    </div>
</div>
