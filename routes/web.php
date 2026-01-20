<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\MusicController as AdminMusicController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\MusicFetchController;
use App\Http\Controllers\VideoFetchController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ReviewController;
// use App\Http\Controllers\Admin\MusicController;

// Main Pages
Route::get('/', function () {
    $latestMusic = \App\Models\Music::where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    $latestVideos = \App\Models\Video::where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    return view('home', compact('latestMusic', 'latestVideos'));
})->name('home');

Route::get('/Music', [MusicFetchController::class, 'index'])->name('music');
Route::get('/Videos', [VideoFetchController::class, 'index'])->name('videos');
Route::get('/About', function () {
    return view('about');
})->name('about');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/Login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/Login', [LoginController::class, 'login'])->name('login.post');
    
    Route::get('/Register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/Register', [RegisterController::class, 'register'])->name('register.post');
});

Route::post('/Logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// User Dashboard Routes - KEEP THIS ONE ONLY
Route::middleware(['auth'])->group(function () {
    // User Profile Routes
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update', [UserController::class, 'update'])->name('user.update');
    });
    
    // Like/Unlike functionality
    Route::post('/Music/{id}/like', [UserController::class, 'likeMusic'])->name('music.like');
    Route::post('/Music/{id}/unlike', [UserController::class, 'unlikeMusic'])->name('music.unlike');
    Route::post('/Video/{id}/like', [UserController::class, 'likeVideo'])->name('video.like');
    Route::post('/Video/{id}/unlike', [UserController::class, 'unlikeVideo'])->name('video.unlike');
});

// Rating and Review Routes
Route::middleware(['auth'])->group(function () {
    // Music Rating & Reviews
    Route::post('/ratings/music/{id}', [RatingController::class, 'rateMusic']);
    Route::post('/reviews/music/{id}', [ReviewController::class, 'addMusicReview']);
    
    // Video Rating & Reviews
    Route::post('/ratings/video/{id}', [RatingController::class, 'rateVideo']);
    Route::post('/reviews/video/{id}', [ReviewController::class, 'addVideoReview']);
});

// Admin Dashboard Routes
Route::middleware(['auth', 'role:admin'])->prefix('Dashboard/Admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Music Management
    Route::get('/Add-Music', [AdminController::class, 'addMusic'])->name('addmusic');
    Route::post('/Add-Music', [AdminMusicController::class, 'store'])->name('storemusic');
    Route::get('/View-Music', [AdminController::class, 'viewMusic'])->name('viewmusic');
    Route::delete('/Music/{id}', [AdminController::class, 'deleteMusic'])->name('deletemusic');    
    Route::get('/Edit-Music/{id}', [AdminController::class, 'editMusic'])->name('editmusic');
    Route::put('/Update-Music/{id}', [AdminMusicController::class, 'update'])->name('updatemusic');
    
    // Video Management
    Route::get('/Add-Video', [AdminController::class, 'addVideo'])->name('addvideo');
    Route::post('/Add-Video', [AdminVideoController::class, 'store'])->name('storevideo');
    Route::get('/View-Videos', [AdminController::class, 'viewVideos'])->name('viewvideos');
    Route::delete('/Video/{id}', [AdminController::class, 'deleteVideo'])->name('deletevideo');
    Route::get('/Edit-Video/{id}', [AdminController::class, 'editVideo'])->name('editvideo');
    Route::put('/Update-Video/{id}', [AdminVideoController::class, 'update'])->name('updatevideo');

    // Category Management
    Route::get('/Manage-Categories', [AdminController::class, 'manageCategories'])->name('managecategories');
    Route::get('/Add-Category', [AdminController::class, 'addCategory'])->name('addcategory');
    Route::post('/Add-Category', [AdminController::class, 'storeCategory'])->name('storecategory');
    Route::delete('/Category/{id}', [AdminController::class, 'deleteCategory'])->name('deletecategory');

    // User Management
    Route::get('/Manage-Users', [AdminController::class, 'manageUsers'])->name('manageusers');
    Route::delete('/Users/{id}', [AdminController::class, 'deleteUser'])->name('deleteuser');
    
    // Review Management
    Route::get('/Manage-Reviews', [AdminController::class, 'manageReviews'])->name('managereviews');
    Route::post('/Approve-Review/{id}', [AdminController::class, 'approveReview'])->name('approve-review');
    Route::delete('/Delete-Review/{id}', [AdminController::class, 'deleteReview'])->name('delete-review');
});