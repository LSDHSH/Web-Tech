<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;

// ==========================================
// ÖFFENTLICHE ROUTEN (Login, Registrierung)
// ==========================================
Route::middleware('guest')->group(function ()
{
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
  
  Route::get('/home', function ()
  {
    return view('pages.home');
  });
  
});


//!MUSS NOCH GEÄNDERT WERDEN

// Hauptseite und weitere Anwendungsseiten
Route::get('/', function ()
{
  return view('pages.index');
});

Route::get('/index', function ()
{
  return view('pages.index');
});

Route::get('/demoquiz', function ()
{
  return view('pages.demoquiz');
});   

Route::get('/quiz', function ()
{
  return view('pages.quiz');
});

Route::get('/home', function ()
  {
    return view('pages.home');
  });

Route::get('/profile', function ()
{
  return view('pages.profile');
});