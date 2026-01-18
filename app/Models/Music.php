<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Music extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'music';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'artist',
        'album',
        'year',
        'genre',
        'language',
        'duration',
        'file_path',
        'cover_image',
        'is_new',
        'is_active',
        'play_count',
        'average_rating',
        'created_by',
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'average_rating' => 'float',
        'play_count' => 'integer',
    ];

    protected $appends = ['is_new_badge', 'average_rating_formatted', 'total_ratings_count'];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($music) {
            if (empty($music->slug)) {
                $music->slug = Str::slug($music->title);
            }
        });
    }

    // Check if music is new (uploaded within 7 days)
    public function getIsNewBadgeAttribute()
    {
        return $this->created_at->diffInDays(Carbon::now()) <= 7;
    }

    // Get full cover image URL
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : null;
    }

    // Get full file URL
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    // Get formatted average rating (e.g., 4.5)
    public function getAverageRatingFormattedAttribute()
    {
        return round($this->average_rating, 1);
    }

    // Get total ratings count
    public function getTotalRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_music');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratable');
    }

    // Update average rating (automatically called when rating is added)
    public function updateAverageRating()
    {
        $avg = $this->ratings()->avg('rating');
        $this->update(['average_rating' => $avg ?? 0]);
    }

    // Increment play count
    public function incrementPlayCount()
    {
        $this->increment('play_count');
    }

    // Get all reviews (alias for reviews() - keeps compatibility)
    public function allReviews()
    {
        return $this->reviews();
    }

    // Get average rating (alias for average_rating field)
    public function averageRating()
    {
        return round($this->average_rating, 1);
    }

    // Get total ratings (alias for getTotalRatingsCountAttribute)
    public function totalRatings()
    {
        return $this->ratings()->count();
    }

    // Get latest reviews with user info
    public function latestReviews($limit = 5)
    {
        return $this->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    // Get ratings distribution (count of each star rating)
    public function ratingsDistribution()
    {
        return $this->ratings()
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->rating => $item->count];
            });
    }

    // Check if a specific user has rated this music
    public function hasUserRated($userId)
    {
        return $this->ratings()->where('user_id', $userId)->exists();
    }

    // Get user's rating for this music
    public function getUserRating($userId)
    {
        $rating = $this->ratings()->where('user_id', $userId)->first();
        return $rating ? $rating->rating : null;
    }

    // Scope for popular music (highest rated)
    public function scopePopular($query, $limit = 10)
    {
        return $query->where('average_rating', '>', 0)
            ->orderBy('average_rating', 'desc')
            ->orderBy('play_count', 'desc')
            ->take($limit);
    }

    // Scope for trending music (recently popular)
    public function scopeTrending($query, $limit = 10)
    {
        return $query->where('is_active', true)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('average_rating', 'desc')
            ->orderBy('play_count', 'desc')
            ->take($limit);
    }
}