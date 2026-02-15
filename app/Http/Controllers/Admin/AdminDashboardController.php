<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
use App\Models\Category;
use App\Models\Attraction;
use App\Models\Accommodation;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    // REMOVED THE CONSTRUCTOR - Middleware is now in routes/web.php

    /**
     * Show admin dashboard
     */
    public function index()
    {
        // Statistics Cards
        $stats = [
            'total_attractions' => Attraction::count(),
            'growth' => '+12 this month',
            'active_users' => User::count(),
            'growth_percent' => '+14.2%',
            'new_listings' => Attraction::where('created_at', '>=', Carbon::now()->subDays(7))->count(),
            'pending' => '5 pending',
            'average_rating' => round(Attraction::avg('rating') ?? 0, 1),
            'reviews_count' => 0,
        ];

        // Visitor Statistics (last 30 days)
        $visitorStats = $this->getVisitorStatistics();

        // User Growth
        $userGrowth = $this->getUserGrowth();

        // Recent Activity
        $recentActivity = $this->getRecentActivity();

        // Most Viewed Attractions
        $mostViewed = Attraction::orderBy('rating', 'desc')->take(3)->get();

        // Highest Rated Hotels
        $highestRated = Accommodation::where('type', 'hotel')
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();

        // Most Reviewed Restaurants
        $mostReviewed = [];

        // Popular Categories
        $popularCategories = Category::withCount('attractions')
            ->orderBy('attractions_count', 'desc')
            ->take(5)
            ->get();

        // Top Countries by Traffic
        $topCountries = Country::withCount('districts')
            ->orderBy('districts_count', 'desc')
            ->take(3)
            ->get();

        // Items Awaiting Approval
        $pendingAttractions = [];
        $pendingReviews = [];

        return view('admin.dashboard', compact(
            'stats',
            'visitorStats',
            'userGrowth',
            'recentActivity',
            'mostViewed',
            'highestRated',
            'mostReviewed',
            'popularCategories',
            'topCountries',
            'pendingAttractions',
            'pendingReviews'
        ));
    }

    /**
     * Manage Countries
     */
    public function countries()
    {
        $countries = Country::withCount('districts')->orderBy('name')->paginate(15);
        return view('admin.countries.index', compact('countries'));
    }

    public function createCountry()
    {
        return view('admin.countries.create');
    }

    public function storeCountry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tagline' => 'required|string|max:255',
            'continent' => 'required|string',
            'languages' => 'required|string',
            'currency' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        Country::create($validated);

        return redirect()->route('admin.countries')->with('success', 'Country created successfully');
    }

    public function editCountry($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }

    public function updateCountry(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tagline' => 'required|string|max:255',
            'continent' => 'required|string',
            'languages' => 'required|string',
            'currency' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $country->update($validated);

        return redirect()->route('admin.countries')->with('success', 'Country updated successfully');
    }

    public function deleteCountry($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.countries')->with('success', 'Country deleted successfully');
    }

    /**
     * Manage Districts
     */
    public function districts()
    {
        $districts = District::with('country')->orderBy('name')->paginate(15);
        return view('admin.districts.index', compact('districts'));
    }

    public function createDistrict()
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.districts.create', compact('countries'));
    }

    public function storeDistrict(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'description' => 'required|string',
            'best_season' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        District::create($validated);

        return redirect()->route('admin.districts')->with('success', 'District created successfully');
    }

    public function editDistrict($id)
    {
        $district = District::findOrFail($id);
        $countries = Country::orderBy('name')->get();
        return view('admin.districts.edit', compact('district', 'countries'));
    }

    public function updateDistrict(Request $request, $id)
    {
        $district = District::findOrFail($id);

        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'description' => 'required|string',
            'best_season' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $district->update($validated);

        return redirect()->route('admin.districts')->with('success', 'District updated successfully');
    }

    public function deleteDistrict($id)
    {
        $district = District::findOrFail($id);
        $district->delete();

        return redirect()->route('admin.districts')->with('success', 'District deleted successfully');
    }

    /**
     * Manage Categories
     */
    public function categories()
    {
        $categories = Category::withCount('attractions')->orderBy('name')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:20',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        Category::create($validated);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:20',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $category->update($validated);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }

    /**
     * Manage Attractions
     */
    public function attractions()
    {
        $attractions = Attraction::with(['district', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.attractions.index', compact('attractions'));
    }

    public function createAttraction()
    {
        $districts = District::with('country')->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('admin.attractions.create', compact('districts', 'categories'));
    }

    public function storeAttraction(Request $request)
    {
        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'rating' => 'nullable|numeric|min:0|max:5',
            'entry_fee' => 'nullable|numeric|min:0',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        Attraction::create($validated);

        return redirect()->route('admin.attractions')->with('success', 'Attraction created successfully');
    }

    public function editAttraction($id)
    {
        $attraction = Attraction::findOrFail($id);
        $districts = District::with('country')->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('admin.attractions.edit', compact('attraction', 'districts', 'categories'));
    }

    public function updateAttraction(Request $request, $id)
    {
        $attraction = Attraction::findOrFail($id);

        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'rating' => 'nullable|numeric|min:0|max:5',
            'entry_fee' => 'nullable|numeric|min:0',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $attraction->update($validated);

        return redirect()->route('admin.attractions')->with('success', 'Attraction updated successfully');
    }

    public function deleteAttraction($id)
    {
        $attraction = Attraction::findOrFail($id);
        $attraction->delete();

        return redirect()->route('admin.attractions')->with('success', 'Attraction deleted successfully');
    }

    /**
     * Manage Accommodations
     */
    public function accommodations()
    {
        $accommodations = Accommodation::with('district')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.accommodations.index', compact('accommodations'));
    }

    public function createAccommodation()
    {
        $districts = District::with('country')->orderBy('name')->get();
        return view('admin.accommodations.create', compact('districts'));
    }

    public function storeAccommodation(Request $request)
    {
        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:hotel,guesthouse,resort,inn,cottage,homestay',
            'price_per_night' => 'required|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'available_rooms' => 'required|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image_url' => 'nullable|url',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        Accommodation::create($validated);

        return redirect()->route('admin.accommodations')->with('success', 'Accommodation created successfully');
    }

    public function editAccommodation($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $districts = District::with('country')->orderBy('name')->get();
        return view('admin.accommodations.edit', compact('accommodation', 'districts'));
    }

    public function updateAccommodation(Request $request, $id)
    {
        $accommodation = Accommodation::findOrFail($id);

        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:hotel,guesthouse,resort,inn,cottage,homestay',
            'price_per_night' => 'required|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'available_rooms' => 'required|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image_url' => 'nullable|url',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $accommodation->update($validated);

        return redirect()->route('admin.accommodations')->with('success', 'Accommodation updated successfully');
    }

    public function deleteAccommodation($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $accommodation->delete();

        return redirect()->route('admin.accommodations')->with('success', 'Accommodation deleted successfully');
    }

    /**
     * Manage Restaurants
     */
    public function restaurants()
    {
        // Check if Restaurant model exists
        if (class_exists('App\Models\Restaurant')) {
            $restaurants = Restaurant::with('district')
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } else {
            $restaurants = collect();
        }

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * User Management
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Manage Reviews
     */
    public function reviews()
    {
        // Check if Review model exists
        if (class_exists('App\Models\Review')) {
            $reviews = Review::with(['user', 'reviewable'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } else {
            $reviews = collect();
        }

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Analytics & Reports
     */
    public function analytics()
    {
        return view('admin.analytics');
    }

    /**
     * System Settings
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Private helper methods
     */
    private function getVisitorStatistics()
    {
        $days = [];
        $values = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days[] = $date->format('M d');
            $values[] = rand(1000, 2000);
        }

        return [
            'days' => $days,
            'values' => $values,
        ];
    }

    private function getUserGrowth()
    {
        $months = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
        $values = [450, 520, 580, 680, 820, 920];

        return [
            'months' => $months,
            'values' => $values,
        ];
    }

    private function getRecentActivity()
    {
        return [
            [
                'type' => 'user',
                'icon' => '👤',
                'text' => 'New user registered: John Doe',
                'time' => '5 minutes ago',
            ],
            [
                'type' => 'attraction',
                'icon' => '📍',
                'text' => 'New attraction added: Sigiriya Rock',
                'time' => '1 hour ago',
            ],
            [
                'type' => 'review',
                'icon' => '⭐',
                'text' => 'Review submitted for Grand Hotel',
                'time' => '2 hours ago',
            ],
            [
                'type' => 'approval',
                'icon' => '✅',
                'text' => 'Admin approved Temple of Tooth',
                'time' => '3 hours ago',
            ],
        ];
    }

    /**
     * Generate Report
     */
    public function generateReport()
    {
        $report = [
            'generated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'total_countries' => Country::count(),
            'total_districts' => District::count(),
            'total_attractions' => Attraction::count(),
            'total_accommodations' => Accommodation::count(),
            'total_restaurants' => class_exists('App\Models\Restaurant') ? Restaurant::count() : 0,
            'total_users' => User::count(),
            'total_reviews' => class_exists('App\Models\Review') ? Review::count() : 0,
        ];

        return view('admin.report', compact('report'));
    }
}
