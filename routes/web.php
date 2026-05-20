<?php

use core\View;
use core\Database;

// Seitenbeispiel
$router->get('/', function()
{
  dd(Database::connect()->query('SELECT * FROM user')->fetchAll());
  return View::render('home', 
  [
    'test' => 'Test'
  ], 'admin');
});

// Direkter string return
$router->get('/strings', function()
{
  return "Hallo";
});

// Direkter array return
$router->get('/array', function()
{
  return
  [
    "Erstes Element",
    "Zweites Element" => 2,
  ];
});

// $router->get('/db-test', function()
// {
//   $db = \core\Database::getConnection();
//   return "Datenbankverbindung erfolgreich hergestellt!";
// });