<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Music;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    // Get reviews for music
    public function getMusicReviews($musicId)
    {
        $music = Music::find($musicId);

        if (!$music) {
            return response()->json([
                'success' => false,
                'message' => 'Music not found'
            ], 404);
        }

        $reviews = $music->reviews()
            ->with('user:id,name')
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }

    // Get reviews for video
    public function getVideoReviews($videoId)
    {
        $video = Video::find($videoId);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found'
            ], 404);
        }

        $reviews = $video->reviews()
            ->with('user:id,name')
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }

    // Add review to music
    public function addMusicReview(Request $request, $musicId)
    {
        $music = Music::find($musicId);

        if (!$music) {
            return response()->json([
                'success' => false,
                'message' => 'Music not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'review_text' => 'required|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user already reviewed
        $existingReview = Review::where('reviewable_type', Music::class)
            ->where('reviewable_id', $musicId)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this music'
            ], 409);
        }

        $review = Review::create([
            'reviewable_type' => Music::class,
            'reviewable_id' => $musicId,
            'user_id' => $request->user()->id,
            'review_text' => $request->review_text,
            'is_approved' => false, // Needs admin approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully. Waiting for admin approval.',
            'data' => $review->load('user:id,name')
        ], 201);
    }

    // Add review to video
    public function addVideoReview(Request $request, $videoId)
    {
        $video = Video::find($videoId);

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'review_text' => 'required|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user already reviewed
        $existingReview = Review::where('reviewable_type', Video::class)
            ->where('reviewable_id', $videoId)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this video'
            ], 409);
        }

        $review = Review::create([
            'reviewable_type' => Video::class,
            'reviewable_id' => $videoId,
            'user_id' => $request->user()->id,
            'review_text' => $request->review_text,
            'is_approved' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully. Waiting for admin approval.',
            'data' => $review->load('user:id,name')
        ], 201);
    }

    // Update review
    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found'
            ], 404);
        }

        // Check if user owns this review
        if ($review->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only update your own reviews'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'review_text' => 'required|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $review->update([
            'review_text' => $request->review_text,
            'is_approved' => false, // Needs re-approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully',
            'data' => $review
        ]);
    }

    // Delete review
    public function destroy(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found'
            ], 404);
        }

        // Check if user owns this review or is admin
        if ($review->user_id !== $request->user()->id && !$request->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully'
        ]);
    }

    // Approve review - ADMIN ONLY
    public function approve($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found'
            ], 404);
        }

        $review->update(['is_approved' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Review approved successfully',
            'data' => $review
        ]);
    }
}