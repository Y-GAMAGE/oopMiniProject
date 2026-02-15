<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\District;
use App\Models\Category;
use App\Models\Attraction;

class CategoryController extends Controller
{
    /**
     * 1. Show all categories in a district (index.blade.php)
     */
    public function index($countrySlug, $districtSlug)
    {
        $country = Country::where('slug', $countrySlug)->firstOrFail();
        $district = District::where('slug', $districtSlug)
            ->where('country_id', $country->id)
            ->firstOrFail();

        $categories = Category::whereHas('attractions', function($query) use ($district) {
                $query->where('district_id', $district->id);
            })
            ->withCount(['attractions' => function($query) use ($district) {
                $query->where('district_id', $district->id);
            }])
            ->orderBy('name')
            ->get();

        $popularAttractions = Attraction::where('district_id', $district->id)
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get()
            ->unique('category_id')
            ->take(3);

        return view('categories.index', compact('country', 'district', 'categories', 'popularAttractions'));
    }

    /**
     * 2. Show single category overview (show.blade.php)
     */
    public function show($countrySlug, $districtSlug, $categorySlug)
    {
        $country = Country::where('slug', $countrySlug)->firstOrFail();
        $district = District::where('slug', $districtSlug)
            ->where('country_id', $country->id)
            ->firstOrFail();
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Get top/featured attractions for this category (limit to 6-9)
        $featuredAttractions = Attraction::where('district_id', $district->id)
            ->where('category_id', $category->id)
            ->orderBy('rating', 'desc')
            ->limit(9)
            ->get();

        // Get total count
        $totalAttractions = Attraction::where('district_id', $district->id)
            ->where('category_id', $category->id)
            ->count();

        return view('categories.show', compact(
            'country',
            'district',
            'category',
            'featuredAttractions',
            'totalAttractions'
        ));
    }

    /**
     * 3. Show all attractions with filters (attractions.blade.php)
     */
    public function attractions(Request $request, $countrySlug, $districtSlug, $categorySlug)
    {
        $country = Country::where('slug', $countrySlug)->firstOrFail();
        $district = District::where('slug', $districtSlug)
            ->where('country_id', $country->id)
            ->firstOrFail();
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Build query
        $query = Attraction::where('district_id', $district->id)
            ->where('category_id', $category->id)
            ->with(['category', 'district']);

        // Search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%");
            });
        }

        // Rating filter
        if ($request->filled('rating')) {
            $query->byRating($request->rating);
        }

        // Entry fee filter
        if ($request->filled('entry_fee')) {
            if ($request->entry_fee === 'free') {
                $query->whereNull('entry_fee');
            } else {
                $query->byEntryFee($request->entry_fee);
            }
        }

        // Facilities filter
        if ($request->filled('facilities')) {
            $facilities = is_array($request->facilities) ? $request->facilities : [$request->facilities];
            $query->withFacilities($facilities);
        }

        // Open now filter
        if ($request->filled('open_now') && $request->open_now == '1') {
            $query->openNow();
        }

        // Sorting
        $sortBy = $request->get('sort', 'rating_desc');
        switch ($sortBy) {
            case 'rating_desc':
                $query->orderByDesc('rating');
                break;
            case 'rating_asc':
                $query->orderBy('rating');
                break;
            case 'name_asc':
                $query->orderBy('name');
                break;
            case 'name_desc':
                $query->orderByDesc('name');
                break;
            case 'reviews':
                $query->orderByDesc('reviews_count');
                break;
            case 'entry_fee':
                $query->orderBy('entry_fee');
                break;
            default:
                $query->orderByDesc('rating');
        }

        // Pagination
        $perPage = $request->get('per_page', 9);
        $attractions = $query->paginate($perPage)->appends($request->query());

        // View mode
        $viewMode = $request->get('view', 'grid');

        // Available facilities for filter
        $availableFacilities = [
            'parking' => 'Parking',
            'wifi' => 'WiFi',
            'restaurant' => 'Restaurant',
            'guide' => 'Tour Guide',
            'wheelchair' => 'Wheelchair Access',
            'restroom' => 'Restroom',
        ];

        return view('categories.attractions', compact(
            'country',
            'district',
            'category',
            'attractions',
            'viewMode',
            'availableFacilities'
        ));
    }
}
