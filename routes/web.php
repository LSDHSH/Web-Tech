<?php

use Illuminate\Support\Facades\Route;

// Hauptseite und weitere Anwendungsseiten
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/demoquiz', function () {
    return view('demoquiz');
});   