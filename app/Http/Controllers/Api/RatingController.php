<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Music;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    // Add or update rating for music
    public function rateMusic(Request $request, $musicId)
    {
        $music = Music::find($musicId);

        if (!$music) {
            return response()->json([
                'success' => false,
                'message' => 'Music not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user already rated
        $existingRating = Rating::where('ratable_type', Music::class)
            ->where('ratable_id', $musicId)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existingRating) {
            // Update existing rating
            $existingRating->update([
                'rating' => $request->rating
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rating updated successfully',
                'data' => $existingRating
            ]);
        }

        // Create new rating
        $rating = Rating::create([
            'ratable_type' => Music::class,
            'ratable_id' => $musicId,
            'user_id' => $request->user()->id,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rating added successfully',
            'data' => $rating
        ], 201);
    }

    // Add or update rating for video
    public function rateVideo(Request $request, $videoId)
    {
        $video = Video::find($videoId);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user already rated
        $existingRating = Rating::where('ratable_type', Video::class)
            ->where('ratable_id', $videoId)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existingRating) {
            // Update existing rating
            $existingRating->update([
                'rating' => $request->rating
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rating updated successfully',
                'data' => $existingRating
            ]);
        }

        // Create new rating
        $rating = Rating::create([
            'ratable_type' => Video::class,
            'ratable_id' => $videoId,
            'user_id' => $request->user()->id,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rating added successfully',
            'data' => $rating
        ], 201);
    }

    // Get user's rating for music
    public function getUserMusicRating(Request $request, $musicId)
    {
        $rating = Rating::where('ratable_type', Music::class)
            ->where('ratable_id', $musicId)
            ->where('user_id', $request->user()->id)
            ->first();

        return response()->json([
            'success' => true,
            'data' => $rating
        ]);
    }

    // Get user's rating for video
    public function getUserVideoRating(Request $request, $videoId)
    {
        $rating = Rating::where('ratable_type', Video::class)
            ->where('ratable_id', $videoId)
            ->where('user_id', $request->user()->id)
            ->first();

        return response()->json([
            'success' => true,
            'data' => $rating
        ]);
    }
}