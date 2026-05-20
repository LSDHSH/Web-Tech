<?php

if (!function_exists('dump'))
{
  // Dump - Gibt Variablen formatiert aus, bricht das Skript aber NICHT ab.
  function dump(...$vars) : void 
  {
    echo "<pre style='background-color: #1c1c1c; color: #00ff66; padding: 20px; font-family: monospace; font-size: 14px; border-radius: 8px; overflow: auto; line-height: 1.5; border: 1px solid #333; margin: 20px; text-align: left;'>";
    
    foreach ($vars as $var)
    {
      echo "\n" . str_repeat("-", 40) . "\n\n";
      var_dump($var);
    }
    
    echo "\n" . str_repeat("-", 40) . "\n</pre>";
  }
}

if (!function_exists('dd'))
{
  // Dump and Die - Gibt Variablen formatiert aus und bricht das Skript ab.
  function dd(...$vars) : void 
  {
    dump(...$vars);
    die();
  }
}

if (!function_exists('env'))
{
  // Holt einen Wert aus den Umgebungsvariablen ($_ENV) oder liefert einen Standardwert.
  function env(string $key, $default = null) 
  {
    if (isset($_ENV[$key]))
    {
      $value = $_ENV[$key];
      if (strtolower($value) === 'true') return true;
      if (strtolower($value) === 'false') return false;
      return $value;
    }

    return $default;
  }
}