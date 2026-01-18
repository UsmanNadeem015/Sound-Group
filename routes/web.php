<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\MusicController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\MusicFetchController;



Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/Music', function () {
    return view('music');
})->name('music');

Route::get('/Videos', function () {
    return view('video');
})->name('videos');

Route::get('/About', function () {
    return view('about');
})->name('about');


Route::middleware('guest')->group(function () {
    // Login
    Route::get('/Login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/Login', [LoginController::class, 'login'])->name('login.post');
    
    // Register
    Route::get('/Register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/Register', [RegisterController::class, 'register'])->name('register.post');
});

// Logout (Authenticated Users Only)
Route::post('/Logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth', 'role:user'])->prefix('Dashboard/User')->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/Edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/Update', [UserController::class, 'update'])->name('user.update');
});


Route::middleware(['auth', 'role:admin'])->prefix('Dashboard/Admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Music Management
    Route::get('/Add-Music', [AdminController::class, 'addMusic'])->name('admin.addmusic');
    Route::post('/Add-Music', [MusicController::class, 'store'])->name('admin.storemusic');
    
    // Viewing Music
    Route::get('/View-Music', [AdminController::class, 'viewMusic'])->name('admin.viewmusic');
    Route::delete('/Music/{id}', [AdminController::class, 'deleteMusic'])->name('admin.deletemusic');    
    
    // Edit Music
    Route::get('/Edit-Music/{id}', [AdminController::class, 'editMusic'])->name('admin.editmusic');
    Route::put('/Update-Music/{id}', [AdminController::class, 'updateMusic'])->name('admin.updatemusic');
    
    // Video Management
    Route::get('/Add-Video', [AdminController::class, 'addVideo'])->name('admin.addvideo');
    Route::post('/Add-Video', [VideoController::class, 'store'])->name('admin.storevideo');
    Route::delete('/Video/{id}', [AdminController::class, 'deleteVideo'])->name('admin.deletevideo');
    
    // User Management
    Route::get('/Manage-Users', [AdminController::class, 'manageUsers'])->name('admin.manageusers');
    Route::delete('/Users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteuser');
});

Route::get('/Music', [MusicFetchController::class, 'index'])->name('music');

Route::get('/', function () {
    // Fetch latest 5 music tracks
    $latestMusic = \App\Models\Music::where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    return view('home', compact('latestMusic'));
})->name('home');