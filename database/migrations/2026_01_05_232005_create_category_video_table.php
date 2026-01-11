<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * PIVOT TABLE: Connects categories to videos
     * 
     * WHY WE NEED THIS:
     * - One video can have multiple categories
     *   Example: "Concert Live 2024" can be:
     *     - Artist: "Rock Legends"
     *     - Genre: "Rock"
     *     - Language: "English"
     *     - Year: "2024"
     * 
     * - One category can belong to multiple videos
     *   Example: Genre "Rock" can have many videos
     * 
     * This is called a MANY-TO-MANY relationship
     */
    public function up(): void
    {
        Schema::create('category_video', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to categories table
            $table->foreignId('category_id')
                  ->constrained()
                  ->onDelete('cascade');
            
            // Foreign key to videos table
            $table->foreignId('video_id')
                  ->constrained()
                  ->onDelete('cascade');
            
            $table->timestamps();
            
            // UNIQUE CONSTRAINT: Same category can't be assigned twice to same video
            $table->unique(['category_id', 'video_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_video');
    }
};