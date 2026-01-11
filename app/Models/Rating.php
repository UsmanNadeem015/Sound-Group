<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'ratable_type',
        'ratable_id',
        'user_id',
        'rating',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Polymorphic relationship (can rate music OR video)
    public function ratable()
    {
        return $this->morphTo();
    }

    // Rating belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Auto-update average rating when rating is created/updated
    protected static function boot()
    {
        parent::boot();
        
        static::saved(function ($rating) {
            $rating->ratable->updateAverageRating();
        });
        
        static::deleted(function ($rating) {
            $rating->ratable->updateAverageRating();
        });
    }
}