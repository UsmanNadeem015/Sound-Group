<?php
namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicFetchController extends Controller
{
    public function index(Request $request)
    {
        $query = Music::where('is_active', true);
        
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
                  ->orWhere('duration', 'LIKE', "%{$searchTerm}%"); // Added duration to search
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
        $music = $query->paginate(12)->withQueryString();
        
        // Get current user's reviews and ratings for these music items
        $userRatings = [];
        $userReviews = [];
        
        if (Auth::check()) {
            $user = Auth::user();
            $musicIds = $music->pluck('id')->toArray();
            
            // Get user's ratings for these music items
            $userRatings = Rating::where('user_id', $user->id)
                ->where('ratable_type', 'App\Models\Music')
                ->whereIn('ratable_id', $musicIds)
                ->get()
                ->keyBy('ratable_id');
            
            // Get user's reviews for these music items
            $userReviews = Review::where('user_id', $user->id)
                ->where('reviewable_type', 'App\Models\Music')
                ->whereIn('reviewable_id', $musicIds)
                ->get()
                ->keyBy('reviewable_id');
            
            // Add edit information to reviews
            $userReviews->each(function ($review) {
                $review->can_edit = $review->created_at->diffInHours(now()) <= 24;
                $review->remaining_edit_time = max(0, 24 - $review->created_at->diffInHours(now()));
            });
        }
        
        // Add additional data for display
        $music->getCollection()->transform(function($song) use ($userRatings, $userReviews) {
            // Use actual duration from database
            $song->duration = $song->duration ?? 'N/A';
            
            // Add other display properties
            $song->is_new_badge = $song->is_new ?? false;
            $song->average_rating = $song->average_rating ?? 0;
            
            // Add user's existing rating
            if (isset($userRatings[$song->id])) {
                $song->user_rating = $userRatings[$song->id]->rating;
                $song->user_rating_id = $userRatings[$song->id]->id;
            } else {
                $song->user_rating = null;
                $song->user_rating_id = null;
            }
            
            // Add user's existing review
            if (isset($userReviews[$song->id])) {
                $song->user_review = $userReviews[$song->id];
                $song->user_review_id = $userReviews[$song->id]->id;
            } else {
                $song->user_review = null;
                $song->user_review_id = null;
            }
            
            return $song;
        });
        
        return view('music', compact('music'));
    }
}