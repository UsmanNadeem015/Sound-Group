<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This table stores user ratings (1-5 stars) for music and videos
     * Uses polymorphic relationship (one table for multiple types)
     * 
     * RATING SYSTEM:
     * - Users rate from 1 to 5 stars
     * - Average rating is calculated and displayed as ★★★★☆
     * - Each user can rate an item only once
     */
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            
            // POLYMORPHIC RELATIONSHIP
            // This allows a rating to belong to EITHER music OR video
            $table->morphs('ratable');
            // Creates: ratable_type (string) and ratable_id (bigint)
            
            // User who gave the rating
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Rating value (1-5 stars)
            // tinyInteger is small number (saves space)
            // unsigned means only positive numbers (1, 2, 3, 4, 5)
            $table->tinyInteger('rating')->unsigned();
            
            $table->timestamps();
            
            // UNIQUE CONSTRAINT: One user can only rate one item once
            // If user rates again, it updates their previous rating
            $table->unique(['ratable_type', 'ratable_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};