<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This table stores all video data from addvideo.blade.php form:
     * - Title, Artist, Album, Year, Genre, Language, Duration
     * - Thumbnail and video file paths
     * - Tracks view counts and ratings
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            
            // MATCHES addvideo.blade.php FORM FIELDS
            
            // Video name (from "Video Name" input)
            $table->string('title');
            
            // URL-friendly slug
            $table->string('slug')->unique();
            
            // Optional description
            $table->text('description')->nullable();
            
            // Artist name (from "Artist" input)
            $table->string('artist');
            
            // Album name (from "Album" input)
            $table->string('album')->nullable();
            
            // Year (from "Year" select dropdown)
            $table->year('year')->nullable();
            
            // Genre (from "Genre" select dropdown)
            $table->string('genre')->nullable();
            
            // Language (from "Language" select dropdown)
            $table->string('language');
            
            // Duration (from "Duration" input - e.g., "45:32")
            $table->string('duration')->nullable();
            
            // FILE PATHS
            
            // Path to video file (uploaded via "Video File" input)
            $table->string('file_path');
            
            // Path to thumbnail image (uploaded via "Thumbnail Image" input)
            $table->string('thumbnail')->nullable();
            
            // DISPLAY FLAGS
            
            // Shows "NEW" badge if true (auto-set for recent uploads)
            $table->boolean('is_new')->default(true);
            
            // Controls visibility
            $table->boolean('is_active')->default(true);
            
            // STATISTICS
            
            // Tracks how many times video was viewed
            $table->integer('view_count')->default(0);
            
            // Average rating from user reviews (0-5)
            $table->decimal('average_rating', 3, 2)->default(0.00);
            
            // RELATIONSHIPS
            
            // Admin who uploaded this video
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();
            
            // Soft delete (video can be "deleted" but kept in database)
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};