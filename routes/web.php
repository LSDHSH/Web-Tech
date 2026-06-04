<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;


Route::get('/login', [AuthController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'create']);









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

Route::get('/demoquiz', function () {
    return view('pages.demoquiz');
});   

Route::get('/quiz', function () {
    return view('pages.quiz');
});

