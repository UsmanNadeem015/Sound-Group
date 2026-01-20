<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoFetchController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::where('is_active', true);
        
        // SEARCH FUNCTIONALITY
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
        
        // Apply category filter if provided
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
        
        // Use pagination
        $videos = $query->paginate(12)->withQueryString();
        
        // Get current user's reviews and ratings for these video items
        $userRatings = [];
        $userReviews = [];
        
        if (Auth::check()) {
            $user = Auth::user();
            $videoIds = $videos->pluck('id')->toArray();
            
            // Get user's ratings for these video items
            $userRatings = Rating::where('user_id', $user->id)
                ->where('ratable_type', 'App\Models\Video')
                ->whereIn('ratable_id', $videoIds)
                ->get()
                ->keyBy('ratable_id');
            
            // Get user's reviews for these video items
            $userReviews = Review::where('user_id', $user->id)
                ->where('reviewable_type', 'App\Models\Video')
                ->whereIn('reviewable_id', $videoIds)
                ->get()
                ->keyBy('reviewable_id');
            
            // Add edit information to reviews
            $userReviews->each(function ($review) {
                $review->can_edit = $review->created_at->diffInHours(now()) <= 24;
                $review->remaining_edit_time = max(0, 24 - $review->created_at->diffInHours(now()));
            });
        }
        
        // Add additional data for display
        $videos->getCollection()->transform(function($video) use ($userRatings, $userReviews) {
            // Use actual duration from database
            $video->duration = $video->duration ?? 'N/A';
            
            // Add other display properties
            $video->is_new_badge = $video->is_new ?? false;
            $video->average_rating = $video->average_rating ?? 0;
            
            // Add user's existing rating
            if (isset($userRatings[$video->id])) {
                $video->user_rating = $userRatings[$video->id]->rating;
                $video->user_rating_id = $userRatings[$video->id]->id;
            } else {
                $video->user_rating = null;
                $video->user_rating_id = null;
            }
            
            // Add user's existing review
            if (isset($userReviews[$video->id])) {
                $video->user_review = $userReviews[$video->id];
                $video->user_review_id = $userReviews[$video->id]->id;
            } else {
                $video->user_review = null;
                $video->user_review_id = null;
            }
            
            return $video;
        });
        
        return view('video', compact('videos'));
    }
}