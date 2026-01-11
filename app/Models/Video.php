<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Video extends Model
{
    use HasFactory, SoftDeletes;

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
        'thumbnail',
        'is_new',
        'is_active',
        'view_count',
        'average_rating',
        'created_by',
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'average_rating' => 'float',
        'view_count' => 'integer',
    ];

    protected $appends = ['is_new_badge'];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($video) {
            if (empty($video->slug)) {
                $video->slug = Str::slug($video->title);
            }
        });
    }

    // Check if video is new (uploaded within 7 days)
    public function getIsNewBadgeAttribute()
    {
        return $this->created_at->diffInDays(Carbon::now()) <= 7;
    }

    // Get full thumbnail URL
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    // Get full file URL
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_video');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratable');
    }

    // Update average rating
    public function updateAverageRating()
    {
        $avg = $this->ratings()->avg('rating');
        $this->update(['average_rating' => $avg ?? 0]);
    }

    // Increment view count
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}