<?php

namespace core;

class Config 
{
  private static array $config = [];
  private static bool $envLoaded = false;

  // Lädt die .env
  private static function loadEnv() : void
  {
    $env = dirname(__DIR__) . '/.env';
        
    if (file_exists($env))
    {
      $lines = file($env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

      foreach ($lines as $line)
      {
        if (strpos(trim($line), '#') === 0) continue;

        if (strpos($line, '=') !== false)
        {
          list($name, $value) = explode('=', $line, 2);
          $name = trim($name);
          $value = trim($value, " \t\n\r\0\x0B\"'");
          $_ENV[$name] = $value;
        }
      }
    }
    self::$envLoaded = true;
  }

  // Lädt die Konfigurationsdatei einmalig
  public static function load(string $file) : void 
  {
    if (!self::$envLoaded)
      self::loadEnv();

    if (file_exists($file))
      self::$config += require_once $file;
  }

  // Zugriff mit Punkt-Notation
  public static function get(string $key, $default = null) 
  {
    $segments = explode('.', $key);
    $conf = self::$config;

    foreach ($segments as $segment)
    {
      if (isset($conf[$segment]))
        $conf = $conf[$segment];
      else
        return $default;
    }

    return $conf;
  }
}