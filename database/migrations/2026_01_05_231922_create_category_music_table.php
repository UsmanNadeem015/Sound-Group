<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * PIVOT TABLE: Connects categories to music tracks
     * 
     * WHY WE NEED THIS:
     * - One music track can have multiple categories
     *   Example: "Dil Ki Baatein" can be:
     *     - Artist: "Arijit Kumar"
     *     - Genre: "Romantic"
     *     - Language: "Hindi"
     *     - Year: "2024"
     * 
     * - One category can belong to multiple music tracks
     *   Example: Genre "Pop" can have many songs
     * 
     * This is called a MANY-TO-MANY relationship
     */
    public function up(): void
    {
        Schema::create('category_music', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to categories table
            $table->foreignId('category_id')
                  ->constrained()
                  ->onDelete('cascade');
            
            // Foreign key to music table
            $table->foreignId('music_id')
                  ->constrained('music')
                  ->onDelete('cascade');
            
            $table->timestamps();
            
            // UNIQUE CONSTRAINT: Same category can't be assigned twice to same music
            $table->unique(['category_id', 'music_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_music');
    }
};