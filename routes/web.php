<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/Music', function () {
    return view('music');
});

Route::get('/Videos', function () {
    return view('video');
});

Route::get('/About', function () {
    return view('about');
});

Route::get('/Login', function () {
    return view('login');
});

Route::get('/Register', function () {
    return view('register');
});
