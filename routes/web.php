<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
Route::get('/', function () {
    return view('welcome');
=======
$router->get('/', function()
{
  return View::render('home');
});

$router->get('/home', function()
{
  return View::render('home');
});

$router->get('/register', function()
{
  return View::render('register');
});

$router->get('/login', function()
{
  return View::render('login');
});

$router->get('/demoquiz', function()
{
  return View::render('demoquiz');
>>>>>>> c9fdc16 (Frontend commit)
});
