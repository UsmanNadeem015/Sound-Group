<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration adds columns to track review edits:
     * - edited_at: When the review was last edited
     * - edit_count: How many times it has been edited
     */
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Add columns for tracking edits
            $table->timestamp('edited_at')->nullable()->after('is_approved');
            $table->integer('edit_count')->default(0)->after('edited_at');
            
            // Add index for better performance when checking user reviews
            $table->index(['reviewable_type', 'reviewable_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['edited_at', 'edit_count']);
            $table->dropIndex(['reviewable_type', 'reviewable_id', 'user_id']);
        });
    }
};