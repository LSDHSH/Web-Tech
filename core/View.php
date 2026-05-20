<?php

namespace core;

class View 
{
  // Rendert eine Page innerhalb eines Layouts
  public static function render(string $view, array $params = [], string $layout = 'app') : void 
  {
    // Macht aus dem Array echte Variablen
    foreach ($params as $key => $value)
      $$key = $value;

    // HTML der Seite abfangen
    ob_start();
    $viewFile = dirname(__DIR__) . "/app/Views/Pages/{$view}.php";
    
    if (file_exists($viewFile))
      include_once $viewFile;
    else
      echo "View [{$view}] nicht gefunden.";
    
    // Der Inhalt der Seite wird in $content gespeichert
    $content = ob_get_clean();

    // Layout laden
    $layoutFile = dirname(__DIR__) . "/app/Views/Layouts/{$layout}.php";
    
    if (file_exists($layoutFile))
      include_once $layoutFile;
    else
      echo $content;
  }
}