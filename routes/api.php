<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ReviewController;

// API routes for music ratings and reviews
Route::middleware(['auth'])->prefix('api')->group(function () {
    // Alias routes to match friend's frontend
    Route::post('/ratings/music/{id}', [RatingController::class, 'rateMusic']);
    Route::post('/reviews/music/{id}', [ReviewController::class, 'addMusicReview']);
    
    // Your proper routes
    Route::post('/music/{id}/rate', [RatingController::class, 'rateMusic']);
    Route::post('/music/{id}/reviews', [ReviewController::class, 'addMusicReview']);
});