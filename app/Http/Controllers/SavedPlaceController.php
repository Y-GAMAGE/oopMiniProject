<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedPlace;
use App\Models\Attraction;
use App\Models\Accommodation;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class SavedPlaceController extends Controller
{
    /**
     * Toggle save/unsave a place
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Attraction,Accommodation,Restaurant',
            'id' => 'required|integer',
        ]);

        $user = Auth::user();
        $saveableType = "App\\Models\\" . $request->type;
        $saveableId = $request->id;

        // Check if already saved
        $saved = SavedPlace::where('user_id', $user->id)
            ->where('saveable_type', $saveableType)
            ->where('saveable_id', $saveableId)
            ->first();

        if ($saved) {
            // Unsave
            $saved->delete();
            return response()->json([
                'success' => true,
                'saved' => false,
                'message' => 'Removed from saved places',
            ]);
        } else {
            // Save
            SavedPlace::create([
                'user_id' => $user->id,
                'saveable_type' => $saveableType,
                'saveable_id' => $saveableId,
            ]);

            return response()->json([
                'success' => true,
                'saved' => true,
                'message' => 'Added to saved places',
            ]);
        }
    }

    /**
     * Get user's saved places
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');

        $query = Auth::user()->savedPlaces()->with('saveable');

        if ($type !== 'all') {
            $saveableType = "App\\Models\\" . ucfirst($type);
            $query->where('saveable_type', $saveableType);
        }

        $savedPlaces = $query->latest()->get();

        return view('user.saved', compact('savedPlaces', 'type'));
    }

    /**
     * Remove from saved places
     */
    public function destroy($id)
    {
        $savedPlace = SavedPlace::where('user_id', Auth::id())
            ->findOrFail($id);

        $savedPlace->delete();

        return redirect()->back()->with('success', 'Removed from saved places');
    }
}
