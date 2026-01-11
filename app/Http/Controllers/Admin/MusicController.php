<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate
        $request->validate([
            'musicName' => 'required|string|max:255',
            'artist'    => 'required|string|max:255',
            'album'     => 'required|string|max:255',
            'year'      => 'required|digits:4',
            'genre'     => 'required|string|max:100',
            'language'  => 'required|string|max:100',
            'description' => 'nullable|string',

            'musicFile' => 'required|file|mimes:mp3,wav,ogg|max:51200', // 50MB
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB
        ]);

        // 2. Store files
        $musicPath = $request->file('musicFile')->store('music/files', 'public');
        $thumbnailPath = $request->file('thumbnail')->store('music/covers', 'public');

        // 3. Create music record
        Music::create([
            'title'       => $request->musicName,
            'slug'        => Str::slug($request->musicName),
            'description' => $request->description,
            'artist'      => $request->artist,
            'album'       => $request->album,
            'year'        => $request->year,
            'genre'       => $request->genre,
            'language'    => $request->language,

            'file_path'   => $musicPath,
            'cover_image' => $thumbnailPath,

            'is_new'      => true,
            'is_active'   => true,
            'play_count'  => 0,
            'average_rating' => 0,

            'created_by'  => Auth::id(),
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Music added successfully');
    }
}
