<?php

// Helper laden
require_once dirname(__DIR__) . '/core/helpers.php';

// Automatisches Laden von Klassen
spl_autoload_register(function ($class)
{
  $root = dirname(__DIR__);
  $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
  
  if (file_exists($file))
    require_once $file;
});

// Konfiguration laden
$confs = ['app', 'database', 'mail'];
foreach ($confs as $conf)
  \core\Config::load(dirname(__DIR__) . "/config/{$conf}.php");

// Core-Komponenten instanziieren
// $session = new core\Session();
$request = new core\Request();
$response = new core\Response();
$router = new core\Router($request, $response);

// Routen einlesen
require_once dirname(__DIR__) . '/routes/web.php';

// Anwendung ausführen
$router->resolve();