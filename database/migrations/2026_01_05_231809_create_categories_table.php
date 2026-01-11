<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This table stores all categories for organizing music and videos
     * Matches the filter buttons in music.blade.php and video.blade.php:
     * - Album, Artist, Year, Genre, Language
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            
            // Category name (e.g., "2024", "Pop", "English", "Arijit Kumar")
            $table->string('name');
            
            // URL-friendly version (e.g., "pop-music", "arijit-kumar")
            $table->string('slug')->unique();
            
            // Type of category (matches filter buttons in your UI)
            $table->enum('type', ['year', 'artist', 'album', 'genre', 'language']);
            
            // Optional description
            $table->text('description')->nullable();
            
            // Optional image for category
            $table->string('image')->nullable();
            
            // Active status (to show/hide categories)
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};