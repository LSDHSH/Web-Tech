<?php

namespace core;

class Router 
{
  protected Request $request;
  protected Response $response;
  protected array $routes = [];

  public function __construct(Request $request, Response $response) 
  {
    $this->request = $request;
    $this->response = $response;
  }

  // Registriert eine GET-Route
  public function get(string $path, $callback) : void 
  {
    $this->routes['get'][$path] = $callback;
  }

  // Registriert eine POST-Route
  public function post(string $path, $callback) : void 
  {
    $this->routes['post'][$path] = $callback;
  }

  // Findet die passende Route und führt sie aus
  public function resolve() 
  {
    $path = $this->request->getPath();
    $method = $this->request->getMethod();
    $callback = $this->routes[$method][$path] ?? false;

    // Wenn die Route nicht existiert, dann 404 Fehlerhandling
    // Soll durch eigene Seite ersetzt werden
    if ($callback === false)
    {
      $this->response->setStatusCode(404);
      echo "404 - Seite nicht gefunden.";
      return;
    }

    // Wenn Callback eine einfache Funktion ist
    if (is_callable($callback))
    {
      $result = call_user_func($callback);
      $this->handleResult($result);
      return $result;
    }

    // Wenn Callback ein Controller und eine Methode ist
    if (is_array($callback)) 
    {
      $controller = new $callback[0]();
      $result = call_user_func([$controller, $callback[1]], $this->request, $this->response);
      $this->handleResult($result);
      return $result;
    }
  }

  // Rückgabetyp flexibel verarbeiten
  protected function handleResult($result) : void 
  {
    if (is_string($result))
      echo $result;
    elseif (is_array($result))
      $this->response->json($result);
  }
}