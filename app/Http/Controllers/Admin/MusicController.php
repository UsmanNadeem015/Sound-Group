<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    /**
     * Store a newly created music in storage.
     */
    public function store(Request $request)
    {
        // Debug: See what's coming in the request
        // \Log::info('Music Form Data:', $request->all());
        // dd($request->all()); // Uncomment temporarily to see form data

        // 1. Validate
        $validated = $request->validate([
            'musicName' => 'required|string|max:255',
            'artist'    => 'required|string|max:255',
            'album'     => 'required|string|max:255',
            'year'      => 'required|digits:4',
            'genre'     => 'required|string|max:100',
            'language'  => 'required|string|max:100',
            'duration'  => 'required|string|max:10',
            'description' => 'nullable|string',
            'musicFile' => 'required|file|mimes:mp3,wav,ogg|max:51200',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Handle custom genre/language
        $genre = $request->genre === 'custom' ? $request->custom_genre : $request->genre;
        $language = $request->language === 'custom' ? $request->custom_language : $request->language;
        
        // Handle custom year if selected
        $year = $request->year;
        if ($request->has('custom_year') && !empty($request->custom_year)) {
            $year = $request->custom_year;
        }

        // Create new category if custom is selected
        if ($request->genre === 'custom' && $request->custom_genre) {
            Category::firstOrCreate([
                'name' => $request->custom_genre,
                'type' => 'genre'
            ], [
                'is_active' => true
            ]);
        }

        if ($request->language === 'custom' && $request->custom_language) {
            Category::firstOrCreate([
                'name' => $request->custom_language,
                'type' => 'language'
            ], [
                'is_active' => true
            ]);
        }
        
        // Create year category
        Category::firstOrCreate([
            'name' => $year,
            'type' => 'year'
        ], [
            'is_active' => true
        ]);

        // 2. Store files
        $musicPath = $request->file('musicFile')->store('music/files', 'public');
        $thumbnailPath = $request->file('thumbnail')->store('music/covers', 'public');

        // 3. Create music record - MAKE SURE DURATION IS INCLUDED
        $music = Music::create([
            'title'       => $request->musicName,
            'slug'        => Str::slug($request->musicName),
            'description' => $request->description,
            'artist'      => $request->artist,
            'album'       => $request->album,
            'year'        => $year,
            'genre'       => $genre,
            'language'    => $language,
            'duration'    => $request->duration,
            
            'file_path'   => $musicPath,
            'cover_image' => $thumbnailPath,

            'is_new'      => true,
            'is_active'   => true,
            'play_count'  => 0,
            'average_rating' => 0,

            'created_by'  => Auth::id(),
        ]);

        // Debug: Check what was saved
        // \Log::info('Music Saved:', $music->toArray());

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Music added successfully');
    }

    /**
     * Update the specified music in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the music record
        $music = Music::findOrFail($id);
        
        // Debug: See what's coming in the request
        // \Log::info('Update Music Form Data:', $request->all());
        
        // 1. Validate
        $validated = $request->validate([
            'musicName' => 'required|string|max:255',
            'artist'    => 'required|string|max:255',
            'album'     => 'required|string|max:255',
            'year'      => 'required|digits:4',
            'genre'     => 'required|string|max:100',
            'language'  => 'required|string|max:100',
            'duration'  => 'required|string|max:10', // Added duration validation
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'musicFile' => 'nullable|file|mimes:mp3,wav,ogg|max:51200',
        ]);

        // Handle custom genre/language
        $genre = $request->genre === 'custom' ? $request->custom_genre : $request->genre;
        $language = $request->language === 'custom' ? $request->custom_language : $request->language;
        
        // Handle custom year if selected
        $year = $request->year;
        if ($request->has('custom_year') && !empty($request->custom_year)) {
            $year = $request->custom_year;
        }

        // Create new category if custom is selected
        if ($request->genre === 'custom' && $request->custom_genre) {
            Category::firstOrCreate([
                'name' => $request->custom_genre,
                'type' => 'genre'
            ], [
                'is_active' => true
            ]);
        }

        if ($request->language === 'custom' && $request->custom_language) {
            Category::firstOrCreate([
                'name' => $request->custom_language,
                'type' => 'language'
            ], [
                'is_active' => true
            ]);
        }
        
        // Create/update year category
        Category::firstOrCreate([
            'name' => $year,
            'type' => 'year'
        ], [
            'is_active' => true
        ]);

        // Prepare data for update
        $updateData = [
            'title'       => $request->musicName,
            'slug'        => Str::slug($request->musicName),
            'description' => $request->description,
            'artist'      => $request->artist,
            'album'       => $request->album,
            'year'        => $year,
            'genre'       => $genre,
            'language'    => $language,
            'duration'    => $request->duration, // Update duration field
        ];
        
        // Handle thumbnail update if provided
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($music->cover_image && Storage::disk('public')->exists($music->cover_image)) {
                Storage::disk('public')->delete($music->cover_image);
            }
            
            $thumbnailPath = $request->file('thumbnail')->store('music/covers', 'public');
            $updateData['cover_image'] = $thumbnailPath;
        }
        
        // Handle music file update if provided
        if ($request->hasFile('musicFile')) {
            // Delete old music file if exists
            if ($music->file_path && Storage::disk('public')->exists($music->file_path)) {
                Storage::disk('public')->delete($music->file_path);
            }
            
            $musicPath = $request->file('musicFile')->store('music/files', 'public');
            $updateData['file_path'] = $musicPath;
        }
        
        // Update the music record
        $music->update($updateData);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Music updated successfully');
    }

    /**
     * Show the form for editing the specified music.
     */
    public function edit($id)
    {
        $music = Music::findOrFail($id);
        return view('admin.edit-music', compact('music')); // Adjust this to your actual edit view
    }

    /**
     * Remove the specified music from storage.
     */
    public function destroy($id)
    {
        $music = Music::findOrFail($id);
        
        // Delete files from storage
        if ($music->cover_image && Storage::disk('public')->exists($music->cover_image)) {
            Storage::disk('public')->delete($music->cover_image);
        }
        
        if ($music->file_path && Storage::disk('public')->exists($music->file_path)) {
            Storage::disk('public')->delete($music->file_path);
        }
        
        // Delete the record
        $music->delete();
        
        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Music deleted successfully');
    }
}