<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\Country;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('search.index', [
                'attractions' => collect(),
                'countries' => collect(),
                'categories' => collect(),
                'query' => ''
            ]);
        }

        $attractions = Attraction::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->with(['country', 'category'])
            ->limit(20)
            ->get();

        $countries = Country::where('name', 'like', "%{$query}%")
            ->withCount('attractions')
            ->limit(5)
            ->get();

        $categories = Category::where('name', 'like', "%{$query}%")
            ->withCount('attractions')
            ->limit(5)
            ->get();

        return view('search.index', compact('attractions', 'countries', 'categories', 'query'));
    }
}
