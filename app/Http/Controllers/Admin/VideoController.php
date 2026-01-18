<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function store(Request $request)
    {
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
