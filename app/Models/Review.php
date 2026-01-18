<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewable_type',
        'reviewable_id',
        'user_id',
        'review_text',  // Keep as review_text for consistency with migration
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Appended attributes
    protected $appends = ['excerpt', 'time_ago'];

    // Polymorphic relationship (can review music OR video)
    public function reviewable()
    {
        return $this->morphTo();
    }

    // Review belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get excerpt of review (first 100 characters)
    public function getExcerptAttribute()
    {
        return Str::limit($this->review_text, 100);
    }

    // Get human-readable time (e.g., "2 days ago")
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // Scope for approved reviews
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    // Scope for pending reviews (not approved)
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    // Scope for reviews by type (music or video)
    public function scopeByType($query, $type)
    {
        return $query->where('reviewable_type', $type);
    }

    // Scope for reviews of specific item
    public function scopeForItem($query, $type, $id)
    {
        return $query->where('reviewable_type', $type)
                    ->where('reviewable_id', $id);
    }

    // Get all reviews for a specific user
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Get latest reviews
    public function scopeLatest($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    // Approve this review
    public function approve()
    {
        $this->update(['is_approved' => true]);
        return $this;
    }

    // Reject this review
    public function reject()
    {
        $this->update(['is_approved' => false]);
        return $this;
    }

    // Check if review is for music
    public function isForMusic()
    {
        return $this->reviewable_type === 'App\Models\Music';
    }

    // Check if review is for video
    public function isForVideo()
    {
        return $this->reviewable_type === 'App\Models\Video';
    }

    // Get the item being reviewed (music or video)
    public function getItemAttribute()
    {
        return $this->reviewable;
    }

    // Get item title (music title or video title)
    public function getItemTitleAttribute()
    {
        return $this->reviewable ? $this->reviewable->title : 'Unknown';
    }

    // Get item type (music or video)
    public function getItemTypeAttribute()
    {
        return $this->isForMusic() ? 'Music' : ($this->isForVideo() ? 'Video' : 'Unknown');
    }
}