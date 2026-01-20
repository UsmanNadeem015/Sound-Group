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

        // Add edit information to each review
        $reviews->each(function ($review) {
            $review->can_edit = $review->created_at->diffInHours(now()) <= 24;
            $review->remaining_edit_time = max(0, 24 - $review->created_at->diffInHours(now()));
        });

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

        // Add edit information to each review
        $reviews->each(function ($review) {
            $review->can_edit = $review->created_at->diffInHours(now()) <= 24;
            $review->remaining_edit_time = max(0, 24 - $review->created_at->diffInHours(now()));
        });

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }

    // Add or edit review to music
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
            // Check if review can be edited (within 24 hours)
            $canEdit = $existingReview->created_at->diffInHours(now()) <= 24;
            
            if (!$canEdit) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only edit your review within 24 hours of posting'
                ], 403);
            }

            // Update existing review
            $existingReview->update([
                'review_text' => $request->review_text,
                'is_approved' => false, // Needs re-approval
                'edited_at' => now(),
                'edit_count' => ($existingReview->edit_count ?? 0) + 1
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Review updated successfully. Waiting for admin approval.',
                'data' => $existingReview->load('user:id,name')
            ]);
        }

        // Create new review
        $review = Review::create([
            'reviewable_type' => Music::class,
            'reviewable_id' => $musicId,
            'user_id' => $request->user()->id,
            'review_text' => $request->review_text,
            'is_approved' => false, // Needs admin approval
            'edited_at' => null,
            'edit_count' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully. Waiting for admin approval.',
            'data' => $review->load('user:id,name')
        ], 201);
    }

    // Add or edit review to video
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
            // Check if review can be edited (within 24 hours)
            $canEdit = $existingReview->created_at->diffInHours(now()) <= 24;
            
            if (!$canEdit) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only edit your review within 24 hours of posting'
                ], 403);
            }

            // Update existing review
            $existingReview->update([
                'review_text' => $request->review_text,
                'is_approved' => false, // Needs re-approval
                'edited_at' => now(),
                'edit_count' => ($existingReview->edit_count ?? 0) + 1
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Review updated successfully. Waiting for admin approval.',
                'data' => $existingReview->load('user:id,name')
            ]);
        }

        // Create new review
        $review = Review::create([
            'reviewable_type' => Video::class,
            'reviewable_id' => $videoId,
            'user_id' => $request->user()->id,
            'review_text' => $request->review_text,
            'is_approved' => false, // Needs admin approval
            'edited_at' => null,
            'edit_count' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully. Waiting for admin approval.',
            'data' => $review->load('user:id,name')
        ], 201);
    }

    // Update specific review by ID
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

        // Check if review can be edited (within 24 hours)
        $canEdit = $review->created_at->diffInHours(now()) <= 24;
        
        if (!$canEdit) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit your review within 24 hours of posting'
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
            'edited_at' => now(),
            'edit_count' => ($review->edit_count ?? 0) + 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully. Waiting for admin approval.',
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

    // Get user's review for specific music
    public function getUserMusicReview(Request $request, $musicId)
    {
        $review = Review::where('reviewable_type', Music::class)
            ->where('reviewable_id', $musicId)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($review) {
            // Add edit information
            $review->can_edit = $review->created_at->diffInHours(now()) <= 24;
            $review->remaining_edit_time = max(0, 24 - $review->created_at->diffInHours(now()));
        }

        return response()->json([
            'success' => true,
            'data' => $review
        ]);
    }

    // Get user's review for specific video
    public function getUserVideoReview(Request $request, $videoId)
    {
        $review = Review::where('reviewable_type', Video::class)
            ->where('reviewable_id', $videoId)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($review) {
            // Add edit information
            $review->can_edit = $review->created_at->diffInHours(now()) <= 24;
            $review->remaining_edit_time = max(0, 24 - $review->created_at->diffInHours(now()));
        }

        return response()->json([
            'success' => true,
            'data' => $review
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