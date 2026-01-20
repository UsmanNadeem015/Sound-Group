<?php

namespace App\Http\Controllers\Admin;  // Note: This is in Admin namespace

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Display videos for frontend (public video page)
     */
public function index(Request $request)
{
    $query = Video::where('is_active', true);
    
    // Filter by specific value if provided
    if ($request->has('filter_value') && $request->filled('filter_value')) {
        $filterValue = $request->input('filter_value');
        $category = $request->input('category', 'genre'); // Default to genre
        
        switch($category) {
            case 'album':
                $query->where('album', 'like', '%' . $filterValue . '%');
                break;
            case 'artist':
                $query->where('artist', 'like', '%' . $filterValue . '%');
                break;
            case 'year':
                $query->where('year', $filterValue);
                break;
            case 'genre':
                $query->where('genre', 'like', '%' . $filterValue . '%');
                break;
            case 'language':
                $query->where('language', 'like', '%' . $filterValue . '%');
                break;
        }
    }
    // Or just order by category
    elseif ($request->has('category') && $request->filled('category')) {
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
    
    $videos = $query->get();
    
    return view('video', compact('videos'));
}

    /**
     * Store new video (this is your existing method)
     */
    public function store(Request $request)
    {
        // Your existing store method...
        // 1. Validation
        $request->validate([
            'videoName' => 'required|string|max:255',
            'artist'    => 'required|string|max:255',
            'album'     => 'required|string|max:255',
            'year'      => 'required|digits:4',
            'genre'     => 'required|string|max:100',
            'language'  => 'required|string|max:100',
            'duration'  => 'required|string|max:20',
            'description' => 'nullable|string',

            'videoFile' => 'required|file|mimes:mp4,avi,mov,mkv|max:512000', // 500MB
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB
        ]);

        // 2. Store files
        $videoPath = $request->file('videoFile')->store('videos/files', 'public');
        $thumbnailPath = $request->file('thumbnail')->store('videos/thumbnails', 'public');

        // 3. Save to DB
        Video::create([
            'title'       => $request->videoName,
            'slug'        => Str::slug($request->videoName),
            'description' => $request->description,
            'artist'      => $request->artist,
            'album'       => $request->album,
            'year'        => $request->year,
            'genre'       => $request->genre,
            'language'    => $request->language,
            'duration'    => $request->duration,

            'file_path'   => $videoPath,
            'thumbnail'   => $thumbnailPath,

            'is_new'      => true,
            'is_active'   => true,
            'view_count'  => 0,
            'average_rating' => 0,

            'created_by'  => Auth::id(),
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Video added successfully');
    }
}