<?php

use Illuminate\Support\Facades\Route;

// Hauptseite und weitere Anwendungsseiten
Route::get('/', function () {
    return view('pages.index');
});

Route::get('/home', function () {
    return view('pages.home');
});

Route::get('/index', function () {
    return view('pages.index');
});

Route::get('/register', function () {
    return view('pages.register');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/demoquiz', function () {
    return view('pages.demoquiz');
});   

Route::get('/quiz', function () {
    return view('pages.quiz');
});

