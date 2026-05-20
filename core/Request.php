<?php

namespace core;

class Request 
{
  // Gibt den HTTP-Pfad zurück
  public function getPath() : string
  {
    $path = $_SERVER['REQUEST_URI'] ?? '/';
    $position = strpos($path, '?');
    
    if ($position === false)
      return $path;

    return substr($path, 0, $position);
  }

  // Gibt die HTTP-Methode zurück
  public function getMethod() : string 
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }

  // Liest alle Formulardaten oder Parameter aus
  public function getBody() : array 
  {
    $body = [];

    if ($this->getMethod() === 'get')
    {
      // filter_input verwandelt HTML Tags in Textzeichen um
      foreach ($_GET as $key => $value)
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if ($this->getMethod() === 'post')
    {
      foreach ($_POST as $key => $value)
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    return $body;
  }
}