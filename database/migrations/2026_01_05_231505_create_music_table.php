<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This table stores all music data from addmusic.blade.php form:
     * - Title, Artist, Album, Year, Genre, Language
     * - Thumbnail image and music file paths
     * - Tracks play counts and ratings
     */
    public function up(): void
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            
            // MATCHES addmusic.blade.php FORM FIELDS
            
            // Music name (from "Music Name" input)
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
            
            // Duration (optional, can be calculated from file)
            $table->string('duration')->nullable();
            
            // FILE PATHS
            
            // Path to music file (uploaded via "Music File" input)
            $table->string('file_path');
            
            // Path to thumbnail/cover image (uploaded via "Thumbnail Image" input)
            $table->string('cover_image')->nullable();
            
            // DISPLAY FLAGS
            
            // Shows "NEW" badge if true (auto-set for recent uploads)
            $table->boolean('is_new')->default(true);
            
            // Controls visibility
            $table->boolean('is_active')->default(true);
            
            // STATISTICS
            
            // Tracks how many times music was played
            $table->integer('play_count')->default(0);
            
            // Average rating from user reviews (0-5)
            $table->decimal('average_rating', 3, 2)->default(0.00);
            
            // RELATIONSHIPS
            
            // Admin who uploaded this music
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();
            
            // Soft delete (music can be "deleted" but kept in database)
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};