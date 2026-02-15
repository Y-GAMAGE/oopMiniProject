<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ADD THIS

class DistrictController extends Controller
{
    public function index(Request $request, $country)
    {
        $country = Country::where('slug', $country)->firstOrFail();
        $query = District::where('country_id', $country->id);

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $sortBy = $request->get('sort', 'alphabetical');
        $query->sortBy($sortBy);

        $viewMode = $request->get('view', 'grid');
        $districts = $query->paginate(9)->appends($request->query());

        return view('districts.index', compact('country', 'districts', 'viewMode', 'sortBy'));
    }

    public function show($country, $district)
    {
        $country = Country::where('slug', $country)->firstOrFail();

        $district = District::where('slug', $district)
            ->where('country_id', $country->id)
            ->with(['attractions.category'])
            ->firstOrFail();

        // Get categories with attraction counts for this district
        $categories = DB::table('attractions') // CHANGED FROM \DB to DB
            ->join('categories', 'attractions.category_id', '=', 'categories.id')
            ->where('attractions.district_id', $district->id)
            ->select('categories.*', DB::raw('COUNT(attractions.id) as attractions_count')) // CHANGED FROM \DB to DB
            ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.description', 'categories.icon', 'categories.color', 'categories.created_at', 'categories.updated_at')
            ->get();

        // Get popular attractions (3-4 from different categories)
        $popularAttractions = $district->attractions()
            ->orderBy('rating', 'desc')
            ->orderBy('reviews_count', 'desc')
            ->limit(4)
            ->get()
            ->unique('category_id')
            ->take(3);

        // Get transport options - COMPLETE THE LINE
        $transportOptions = config("transport.{$country->slug}.{$district->slug}", []);

        return view('districts.show', compact('country', 'district', 'categories', 'popularAttractions', 'transportOptions'));
    }
}
