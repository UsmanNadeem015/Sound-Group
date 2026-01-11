<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This table stores user reviews for BOTH music and videos
     * Uses polymorphic relationship (one table for multiple types)
     * 
     * HOW IT WORKS:
     * - reviewable_type: 'App\Models\Music' or 'App\Models\Video'
     * - reviewable_id: The ID of the music or video
     * - This allows reviews for both music and videos in one table
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            
            // POLYMORPHIC RELATIONSHIP
            // This allows a review to belong to EITHER music OR video
            $table->morphs('reviewable');
            // Creates: reviewable_type (string) and reviewable_id (bigint)
            
            // User who wrote the review
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // The actual review text
            $table->text('review_text');
            
            // Admin can approve/reject reviews
            $table->boolean('is_approved')->default(false);
            
            $table->timestamps();
            
            // UNIQUE CONSTRAINT: One user can only review one item once
            // User can't write multiple reviews for the same music/video
            $table->unique(['reviewable_type', 'reviewable_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};