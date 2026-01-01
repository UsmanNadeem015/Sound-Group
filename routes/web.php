<?php

use Illuminate\Support\Facades\Route;

// Main Pages
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


// User dash and edit
Route::get('/Dashboard/User', function () {
    return view('userdash');
});

Route::get('/Dashboard/User/Edit', function () {
    return view('useredit');
});

// Admin dash
Route::get('/Dashboard/Admin', function () {
    return view('admindash');
});

Route::get('/Dashboard/Admin/Add-Music', function () {
    return view('addmusic');
});

Route::get('/Dashboard/Admin/Add-Video', function () {
    return view('addvideo');
});

Route::get('/Dashboard/Admin/Manage-Users', function () {
    return view('manageusers');
});

