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

    protected $appends = ['is_new_badge'];

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

    // Update average rating
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
}