<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WordleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;

// ==========================================
// ÖFFENTLICHE ROUTEN (Login, Registrierung)
// ==========================================
Route::middleware('guest')->group(function ()
{
  Route::view('/', 'pages.index');
  
  Route::get('/login', [AuthController::class, 'show'])->name('login');
  Route::post('/login', [AuthController::class, 'login']);
  
  Route::get('/register', [RegisterController::class, 'show']);
  Route::post('/register', [RegisterController::class, 'register']);
  
  Route::get('/verify', [RegisterController::class, 'verify'])
  ->middleware(['signed'])
  ->name('verify');
  
  Route::get('/2fa', [TwoFactorController::class, 'show']);
  Route::post('/2fa', [TwoFactorController::class, 'verify']);
  
  Route::get('/2fa-resend', [TwoFactorController::class, 'resend']);
});

// ==========================================
// Absolut geschützt (Passwort + E-Mail + 2FA)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function ()
{ 
  Route::post('/logout', [AuthController::class, 'logout']);
  
  Route::get('/{mode}/wordle', [WordleController::class, 'show'])
  ->whereIn('mode', ['countries', 'movies', 'series', 'games']);
  Route::post('/{mode}/wordle/guess', [WordleController::class, 'guess'])
  ->whereIn('mode', ['countries', 'movies', 'series', 'games']);
  
  Route::get('/profile', [UserController::class, 'edit']);
  Route::put('/profile/update', [UserController::class, 'update']);
  Route::delete('/profile/delete', [UserController::class, 'destroy']);
  
  Route::view('/home', 'pages.home');
});

// ==========================================
// Admin Bereich (Passwort + E-Mail + 2FA + Admin)
// ==========================================
Route::middleware(['auth', 'admin'])->group(function ()
{
  Route::get('/admin', [AdminController::class, 'index']);
  Route::post('/admin/update/{user}', [AdminController::class, 'update']);
  Route::post('/admin/delete/{user}', [AdminController::class, 'destroy']);
});