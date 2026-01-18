<?php

namespace App\Http\Controllers\Api;  // Keep this correct namespace

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MusicController extends Controller
{
    // Get all music (for music.blade.php)
    public function index(Request $request)
    {
        $query = Music::with(['categories', 'creator'])
            ->where('is_active', true);

        // Search by title or artist
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('artist', 'like', "%{$search}%");
            });
        }

        // Filter by category type
        if ($request->has('filter') && $request->filter != 'All') {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('name', $request->filter);
            });
        }

        // Filter by year
        if ($request->has('year')) {
            $query->where('year', $request->year);
        }

        // Filter by genre
        if ($request->has('genre')) {
            $query->where('genre', $request->genre);
        }

        // Filter by language
        if ($request->has('language')) {
            $query->where('language', $request->language);
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $music = $query->paginate($request->get('per_page', 20));

        return response()->json([
            'success' => true,
            'data' => $music
        ]);
    }

    // Get latest 5 music (for home.blade.php)
    public function latest()
    {
        $music = Music::with(['categories', 'creator'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $music
        ]);
    }

    // Get single music details
    public function show($id)
    {
        $music = Music::with(['categories', 'creator', 'reviews.user', 'ratings'])
            ->find($id);

        if (!$music) {
            return response()->json([
                'success' => false,
                'message' => 'Music not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $music
        ]);
    }

    // Add new music (matches addmusic.blade.php form) - ADMIN ONLY
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'musicFile' => 'required|mimes:mp3,wav,ogg|max:51200', // 50MB
            'musicName' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'genre' => 'required|string',
            'language' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Upload thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . Str::slug($request->musicName) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('images/music', $thumbnailName, 'public');
        }

        // Upload music file
        $musicFile = $request->file('musicFile');
        $musicFileName = time() . '_' . Str::slug($request->musicName) . '.' . $musicFile->getClientOriginalExtension();
        $musicFilePath = $musicFile->storeAs('music', $musicFileName, 'public');

        // Create music record
        $music = Music::create([
            'title' => $request->musicName,
            'slug' => Str::slug($request->musicName),
            'description' => $request->description,
            'artist' => $request->artist,
            'album' => $request->album,
            'year' => $request->year,
            'genre' => $request->genre,
            'language' => $request->language,
            'file_path' => $musicFilePath,
            'cover_image' => $thumbnailPath,
            'is_new' => true,
            'is_active' => true,
            'created_by' => $request->user()->id,
        ]);

        // Attach categories
        $this->attachCategories($music, $request);

        return response()->json([
            'success' => true,
            'message' => 'Music added successfully',
            'data' => $music->load('categories')
        ], 201);
    }

    // Update music - ADMIN ONLY
    public function update(Request $request, $id)
    {
        $music = Music::find($id);

        if (!$music) {
            return response()->json([
                'success' => false,
                'message' => 'Music not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'musicFile' => 'sometimes|mimes:mp3,wav,ogg|max:51200',
            'musicName' => 'sometimes|string|max:255',
            'artist' => 'sometimes|string|max:255',
            'album' => 'sometimes|string|max:255',
            'year' => 'sometimes|digits:4',
            'genre' => 'sometimes|string',
            'language' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update thumbnail if provided
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($music->cover_image) {
                Storage::disk('public')->delete($music->cover_image);
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . Str::slug($request->musicName ?? $music->title) . '.' . $thumbnail->getClientOriginalExtension();
            $music->cover_image = $thumbnail->storeAs('images/music', $thumbnailName, 'public');
        }

        // Update music file if provided
        if ($request->hasFile('musicFile')) {
            // Delete old file
            Storage::disk('public')->delete($music->file_path);

            $musicFile = $request->file('musicFile');
            $musicFileName = time() . '_' . Str::slug($request->musicName ?? $music->title) . '.' . $musicFile->getClientOriginalExtension();
            $music->file_path = $musicFile->storeAs('music', $musicFileName, 'public');
        }

        // Update other fields
        $music->update($request->only([
            'musicName' => 'title',
            'artist',
            'album',
            'year',
            'genre',
            'language',
            'description'
        ]));

        // Update categories if provided
        if ($request->has('year') || $request->has('artist') || $request->has('album') || $request->has('genre') || $request->has('language')) {
            $this->attachCategories($music, $request);
        }

        return response()->json([
            'success' => true,
            'message' => 'Music updated successfully',
            'data' => $music->load('categories')
        ]);
    }

    // Delete music - ADMIN ONLY
    public function destroy($id)
    {
        $music = Music::find($id);

        if (!$music) {
            return response()->json([
                'success' => false,
                'message' => 'Music not found'
            ], 404);
        }

        // Delete files
        if ($music->cover_image) {
            Storage::disk('public')->delete($music->cover_image);
        }
        Storage::disk('public')->delete($music->file_path);

        // Soft delete
        $music->delete();

        return response()->json([
            'success' => true,
            'message' => 'Music deleted successfully'
        ]);
    }

    // Increment play count
    public function play($id)
    {
        $music = Music::find($id);

        if (!$music) {
            return response()->json([
                'success' => false,
                'message' => 'Music not found'
            ], 404);
        }

        $music->incrementPlayCount();

        return response()->json([
            'success' => true,
            'message' => 'Play count updated',
            'play_count' => $music->play_count
        ]);
    }

    // Helper method to attach categories
    private function attachCategories($music, $request)
    {
        $categoryIds = [];

        // Find or create Year category
        if ($request->has('year')) {
            $yearCategory = Category::firstOrCreate([
                'name' => $request->year,
                'type' => 'year'
            ], [
                'slug' => Str::slug($request->year),
                'is_active' => true
            ]);
            $categoryIds[] = $yearCategory->id;
        }

        // Find or create Artist category
        if ($request->has('artist')) {
            $artistCategory = Category::firstOrCreate([
                'name' => $request->artist,
                'type' => 'artist'
            ], [
                'slug' => Str::slug($request->artist),
                'is_active' => true
            ]);
            $categoryIds[] = $artistCategory->id;
        }

        // Find or create Album category
        if ($request->has('album')) {
            $albumCategory = Category::firstOrCreate([
                'name' => $request->album,
                'type' => 'album'
            ], [
                'slug' => Str::slug($request->album),
                'is_active' => true
            ]);
            $categoryIds[] = $albumCategory->id;
        }

        // Find or create Genre category
        if ($request->has('genre')) {
            $genreCategory = Category::firstOrCreate([
                'name' => $request->genre,
                'type' => 'genre'
            ], [
                'slug' => Str::slug($request->genre),
                'is_active' => true
            ]);
            $categoryIds[] = $genreCategory->id;
        }

        // Find or create Language category
        if ($request->has('language')) {
            $languageCategory = Category::firstOrCreate([
                'name' => $request->language,
                'type' => 'language'
            ], [
                'slug' => Str::slug($request->language),
                'is_active' => true
            ]);
            $categoryIds[] = $languageCategory->id;
        }

        // Sync categories
        $music->categories()->sync($categoryIds);
    }
}