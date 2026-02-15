<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $query = Country::query();

        // Search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Continent filter
        if ($request->filled('continent')) {
            $query->where('continent', $request->continent);
        }

        // Sorting
        $sortBy = $request->get('sort', 'alphabetical');
        switch ($sortBy) {
            case 'most_districts':
                $query->orderByDesc('districts_count');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->orderBy('name');
        }

        // REMOVED withCount - use hardcoded values
        $countries = $query->paginate(12)->appends($request->query());

        $continents = Country::select('continent')
            ->distinct()
            ->whereNotNull('continent')
            ->orderBy('continent')
            ->pluck('continent');

        $viewMode = $request->get('view', 'grid');

        return view('countries.index', compact('countries', 'continents', 'viewMode'));
    }

    public function show($slug)
    {
        // REMOVED withCount - use hardcoded values
        $country = Country::where('slug', $slug)
            ->with(['districts' => fn($q) => $q->orderBy('name')])
            ->firstOrFail();

         // Get top attractions through districts (not directly from country)
        $topAttractions = \App\Models\Attraction::whereHas('district', function($query) use ($country) {
                $query->where('country_id', $country->id);
            })
            ->with(['category', 'district'])
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        return view('countries.show', compact('country', 'topAttractions'));
    }
}
