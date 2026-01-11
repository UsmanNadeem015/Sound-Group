<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewable_type',
        'reviewable_id',
        'user_id',
        'review_text',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

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
}