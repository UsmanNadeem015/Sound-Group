<?php
namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class MusicFetchController extends Controller
{
    public function index(Request $request)
    {
        $query = Music::where('is_active', true);
        
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
        
        $music = $query->get();
        
        // Add additional data for display
        $music = $music->map(function($song) {
            // Calculate duration (you need to store this in your database)
            // For now, let's add a placeholder
            $song->duration = '3:45'; // Placeholder - you need to store actual duration
            
            // Add other display properties
            $song->is_new_badge = $song->is_new ?? false;
            $song->average_rating = $song->average_rating ?? 4; // Placeholder
            
            return $song;
        });
        
        return view('music', compact('music'));
    }
}