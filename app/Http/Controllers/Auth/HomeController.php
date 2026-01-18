<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Get home page data (for home.blade.php)
    public function index()
    {
        // Get latest 5 music
        $latestMusic = Music::with(['categories', 'creator'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get latest 5 videos
        $latestVideos = Video::with(['categories', 'creator'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get statistics
        $stats = [
            'total_music' => Music::where('is_active', true)->count(),
            'total_videos' => Video::where('is_active', true)->count(),
            'total_artists' => Category::where('type', 'artist')->where('is_active', true)->count(),
            'total_languages' => Category::where('type', 'language')->where('is_active', true)->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'latest_music' => $latestMusic,
                'latest_videos' => $latestVideos,
                'statistics' => $stats
            ]
        ]);
    }
}