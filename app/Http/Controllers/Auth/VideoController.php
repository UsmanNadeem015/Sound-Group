<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    // Get all videos (for video.blade.php)
    public function index(Request $request)
    {
        $query = Video::with(['categories', 'creator'])
            ->where('is_active', true);

        // Search by title or artist
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('artist', 'like', "%{$search}%");
            });
        }

        // Filter by category
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

        $videos = $query->paginate($request->get('per_page', 20));

        return response()->json([
            'success' => true,
            'data' => $videos
        ]);
    }

    // Get latest 5 videos (for home.blade.php)
    public function latest()
    {
        $videos = Video::with(['categories', 'creator'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $videos
        ]);
    }

    // Get single video details
    public function show($id)
    {
        $video = Video::with(['categories', 'creator', 'reviews.user', 'ratings'])
            ->find($id);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $video
        ]);
    }

    // Add new video (matches addvideo.blade.php form) - ADMIN ONLY
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'videoFile' => 'required|mimes:mp4,avi,mov,mkv|max:512000', // 500MB
            'videoName' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'genre' => 'required|string',
            'language' => 'required|string',
            'duration' => 'required|string',
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
            $thumbnailName = time() . '_' . Str::slug($request->videoName) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('images/videos', $thumbnailName, 'public');
        }

        // Upload video file
        $videoFile = $request->file('videoFile');
        $videoFileName = time() . '_' . Str::slug($request->videoName) . '.' . $videoFile->getClientOriginalExtension();
        $videoFilePath = $videoFile->storeAs('videos', $videoFileName, 'public');

        // Create video record
        $video = Video::create([
            'title' => $request->videoName,
            'slug' => Str::slug($request->videoName),
            'description' => $request->description,
            'artist' => $request->artist,
            'album' => $request->album,
            'year' => $request->year,
            'genre' => $request->genre,
            'language' => $request->language,
            'duration' => $request->duration,
            'file_path' => $videoFilePath,
            'thumbnail' => $thumbnailPath,
            'is_new' => true,
            'is_active' => true,
            'created_by' => $request->user()->id,
        ]);

        // Attach categories
        $this->attachCategories($video, $request);

        return response()->json([
            'success' => true,
            'message' => 'Video added successfully',
            'data' => $video->load('categories')
        ], 201);
    }

    // Update video - ADMIN ONLY
    public function update(Request $request, $id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'videoFile' => 'sometimes|mimes:mp4,avi,mov,mkv|max:512000',
            'videoName' => 'sometimes|string|max:255',
            'artist' => 'sometimes|string|max:255',
            'album' => 'sometimes|string|max:255',
            'year' => 'sometimes|digits:4',
            'genre' => 'sometimes|string',
            'language' => 'sometimes|string',
            'duration' => 'sometimes|string',
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
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . Str::slug($request->videoName ?? $video->title) . '.' . $thumbnail->getClientOriginalExtension();
            $video->thumbnail = $thumbnail->storeAs('images/videos', $thumbnailName, 'public');
        }

        // Update video file if provided
        if ($request->hasFile('videoFile')) {
            Storage::disk('public')->delete($video->file_path);

            $videoFile = $request->file('videoFile');
            $videoFileName = time() . '_' . Str::slug($request->videoName ?? $video->title) . '.' . $videoFile->getClientOriginalExtension();
            $video->file_path = $videoFile->storeAs('videos', $videoFileName, 'public');
        }

        // Update other fields
        $video->update($request->only([
            'videoName' => 'title',
            'artist',
            'album',
            'year',
            'genre',
            'language',
            'duration',
            'description'
        ]));

        // Update categories
        if ($request->has('year') || $request->has('artist') || $request->has('album') || $request->has('genre') || $request->has('language')) {
            $this->attachCategories($video, $request);
        }

        return response()->json([
            'success' => true,
            'message' => 'Video updated successfully',
            'data' => $video->load('categories')
        ]);
    }

    // Delete video - ADMIN ONLY
    public function destroy($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found'
            ], 404);
        }

        // Delete files
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        Storage::disk('public')->delete($video->file_path);

        // Soft delete
        $video->delete();

        return response()->json([
            'success' => true,
            'message' => 'Video deleted successfully'
        ]);
    }

    // Increment view count
    public function view($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found'
            ], 404);
        }

        $video->incrementViewCount();

        return response()->json([
            'success' => true,
            'message' => 'View count updated',
            'view_count' => $video->view_count
        ]);
    }

    // Helper method to attach categories
    private function attachCategories($video, $request)
    {
        $categoryIds = [];

        // Year
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

        // Artist
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

        // Album
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

        // Genre
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

        // Language
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
        $video->categories()->sync($categoryIds);
    }
}