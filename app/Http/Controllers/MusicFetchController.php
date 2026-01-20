<?php
namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class MusicFetchController extends Controller
{
    public function index(Request $request)
    {
        $query = Music::where('is_active', true);
        
        // SEARCH FUNCTIONALITY
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('artist', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('album', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('year', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('genre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('language', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('duration', 'LIKE', "%{$searchTerm}%"); // Added duration to search
            });
        }
        
        // Apply category filter if provided
        if ($request->has('category') && $request->filled('category')) {
            $category = $request->input('category');
            switch($category) {
                case 'album':
                    $query->orderBy('album');
                    break;
                case 'artist':
                    $query->orderBy('artist');
                    break;
                case 'year':
                    $query->orderBy('year', 'desc');
                    break;
                case 'genre':
                    $query->orderBy('genre');
                    break;
                case 'language':
                    $query->orderBy('language');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        // Use pagination
        $music = $query->paginate(12)->withQueryString();
        
        // Add additional data for display - FIX DURATION DISPLAY
        $music->getCollection()->transform(function($song) {
            // Use actual duration from database
            $song->duration = $song->duration ?? 'N/A'; // Use 'N/A' only if null
            
            // Add other display properties
            $song->is_new_badge = $song->is_new ?? false;
            $song->average_rating = $song->average_rating ?? 0;
            
            return $song;
        });
        
        return view('music', compact('music'));
    }


}