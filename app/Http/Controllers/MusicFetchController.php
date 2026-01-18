<?php

namespace App\Http\Controllers;

use App\Models\Music;

class MusicFetchController extends Controller
{
    public function index()
    {
        $music = Music::latest()->get();
        return view('music', compact('music'));
    }
}
