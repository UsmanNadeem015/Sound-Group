<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoFetchController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::where('is_active', true);
        
        // SEARCH FUNCTIONALITY - Similar to MusicFetchController
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
                  ->orWhere('duration', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Apply category filter if provided (from URL parameter 'category')
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
        
        // Use pagination with search parameters
        $videos = $query->paginate(12)->withQueryString();
        
        // Add additional data for display - similar to MusicFetchController
        $videos->getCollection()->transform(function($video) {
            // Use actual duration from database
            $video->duration = $video->duration ?? 'N/A';
            
            // Add other display properties
            $video->is_new_badge = $video->is_new ?? false;
            $video->average_rating = $video->average_rating ?? 0;
            
            return $video;
        });
        
        return view('video', compact('videos'));
    }
}