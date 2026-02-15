<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\SavedPlaceController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\RestaurantController;

// ============================================
// HOMEPAGE
// ============================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ============================================
// AUTHENTICATION ROUTES
// ============================================
// Guest routes (not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Google OAuth
    Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});

// Authenticated routes (logged in users only)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ============================================
// USER DASHBOARD ROUTES
// ============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::get('/settings', [UserDashboardController::class, 'settings'])->name('user.settings');
    Route::get('/my-trips', [UserDashboardController::class, 'trips'])->name('user.trips');
    Route::get('/saved-places', [UserDashboardController::class, 'saved'])->name('user.saved');
    Route::get('/my-reviews', [UserDashboardController::class, 'reviews'])->name('user.reviews');

    // Saved Places
    Route::post('/saved-places/toggle', [SavedPlaceController::class, 'toggle'])->name('saved.toggle');
    Route::delete('/saved-places/{id}', [SavedPlaceController::class, 'destroy'])->name('saved.destroy');
    // Trip creation route (placeholder - will be implemented later)
    Route::get('/trips/create', function() {
        return view('user.trips');
    })->name('trips.create');
});

// ============================================
// ADMIN DASHBOARD ROUTES
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Countries
    Route::get('/countries', [AdminDashboardController::class, 'countries'])->name('countries');
    Route::get('/countries/create', [AdminDashboardController::class, 'createCountry'])->name('countries.create');
    Route::post('/countries', [AdminDashboardController::class, 'storeCountry'])->name('countries.store');
    Route::get('/countries/{id}/edit', [AdminDashboardController::class, 'editCountry'])->name('countries.edit');
    Route::put('/countries/{id}', [AdminDashboardController::class, 'updateCountry'])->name('countries.update');
    Route::delete('/countries/{id}', [AdminDashboardController::class, 'deleteCountry'])->name('countries.delete');

    // Districts
    Route::get('/districts', [AdminDashboardController::class, 'districts'])->name('districts');
    Route::get('/districts/create', [AdminDashboardController::class, 'createDistrict'])->name('districts.create');
    Route::post('/districts', [AdminDashboardController::class, 'storeDistrict'])->name('districts.store');
    Route::get('/districts/{id}/edit', [AdminDashboardController::class, 'editDistrict'])->name('districts.edit');
    Route::put('/districts/{id}', [AdminDashboardController::class, 'updateDistrict'])->name('districts.update');
    Route::delete('/districts/{id}', [AdminDashboardController::class, 'deleteDistrict'])->name('districts.delete');

    // Categories
    Route::get('/categories', [AdminDashboardController::class, 'categories'])->name('categories');
    Route::get('/categories/create', [AdminDashboardController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories', [AdminDashboardController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{id}/edit', [AdminDashboardController::class, 'editCategory'])->name('categories.edit');
    Route::put('/categories/{id}', [AdminDashboardController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminDashboardController::class, 'deleteCategory'])->name('categories.delete');

    // Attractions
    Route::get('/attractions', [AdminDashboardController::class, 'attractions'])->name('attractions');
    Route::get('/attractions/create', [AdminDashboardController::class, 'createAttraction'])->name('attractions.create');
    Route::post('/attractions', [AdminDashboardController::class, 'storeAttraction'])->name('attractions.store');
    Route::get('/attractions/{id}/edit', [AdminDashboardController::class, 'editAttraction'])->name('attractions.edit');
    Route::put('/attractions/{id}', [AdminDashboardController::class, 'updateAttraction'])->name('attractions.update');
    Route::delete('/attractions/{id}', [AdminDashboardController::class, 'deleteAttraction'])->name('attractions.delete');

    // Accommodations
    Route::get('/accommodations', [AdminDashboardController::class, 'accommodations'])->name('accommodations');
    Route::get('/accommodations/create', [AdminDashboardController::class, 'createAccommodation'])->name('accommodations.create');
    Route::post('/accommodations', [AdminDashboardController::class, 'storeAccommodation'])->name('accommodations.store');
    Route::get('/accommodations/{id}/edit', [AdminDashboardController::class, 'editAccommodation'])->name('accommodations.edit');
    Route::put('/accommodations/{id}', [AdminDashboardController::class, 'updateAccommodation'])->name('accommodations.update');
    Route::delete('/accommodations/{id}', [AdminDashboardController::class, 'deleteAccommodation'])->name('accommodations.delete');

    // Restaurants
    Route::get('/restaurants', [AdminDashboardController::class, 'restaurants'])->name('restaurants');

    // Users
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');

    // Reviews
    Route::get('/reviews', [AdminDashboardController::class, 'reviews'])->name('reviews');

    // Analytics
    Route::get('/analytics', [AdminDashboardController::class, 'analytics'])->name('analytics');

    // Settings
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('settings');

    // Generate Report
    Route::get('/report', [AdminDashboardController::class, 'generateReport'])->name('report');
});

// ============================================
// SEARCH (MUST BE BEFORE OTHER ROUTES)
// ============================================
Route::get('/search', [SearchController::class, 'index'])->name('search');

// ============================================
// COUNTRIES
// ============================================
Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/countries/{slug}', [CountryController::class, 'show'])->name('countries.show');

// ============================================
// DISTRICTS (within a country)
// ============================================
Route::get('/countries/{country}/districts', [DistrictController::class, 'index'])->name('countries.districts.index');
Route::get('/countries/{country}/districts/{district}', [DistrictController::class, 'show'])->name('countries.districts.show');

// ============================================
// CATEGORIES (within a district)
// ============================================
// Show category cards in a district
Route::get('/countries/{country}/districts/{district}/categories', [CategoryController::class, 'index'])
    ->name('countries.districts.categories.index');

// Show single category overview with featured attractions
Route::get('/countries/{country}/districts/{district}/categories/{category}', [CategoryController::class, 'show'])
    ->name('countries.districts.categories.show');

// Show all attractions in a category with filters
Route::get('/countries/{country}/districts/{district}/categories/{category}/attractions', [CategoryController::class, 'attractions'])
    ->name('countries.districts.categories.attractions');

// ============================================
// SINGLE ATTRACTION DETAIL PAGE
// ============================================
Route::get('/countries/{country}/districts/{district}/categories/{category}/attractions/{attraction}', [AttractionController::class, 'show'])
    ->name('attractions.show');

// ============================================
// ACCOMMODATIONS
// ============================================
Route::get('/countries/{country}/districts/{district}/categories/{category}/attractions/{attraction}/accommodations',
    [AccommodationController::class, 'nearAttraction'])
    ->name('accommodations.near-attraction');

    Route::get('/countries/{country}/districts/{district}/categories/{category}/attractions/{attraction}/dining',
    [RestaurantController::class, 'nearAttraction'])
    ->name('restaurants.near-attraction');
