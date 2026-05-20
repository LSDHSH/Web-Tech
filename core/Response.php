<?php

namespace core;

class Response 
{
  // Setzt den HTTP-Statuscode
  public function setStatusCode(int $code) : void 
  {
    http_response_code($code);
  }

  // Setzt einen HTTP-Header
  public function setHeader(string $name, string $value) : void 
  {
    header("$name: $value");
  }

  // Weiterleitung
  public function redirect(string $url) : void 
  {
    $this->setHeader('Location', $url);
    die();
  }

  // Sendet eine JSON-Antwort
  public function json(array $data) : void 
  {
    $this->setHeader('Content-Type', 'application/json');
    echo json_encode($data);
  }
}