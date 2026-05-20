<?php

namespace core;

use PDO;
use PDOException;

class Database 
{
  private static ?PDO $connection = null;

  // Holt die bestehende Verbindung oder baut eine neue auf
  public static function connect() : PDO 
  {
    if (self::$connection === null)
    {
      $driver = strtolower(Config::get('db.connection'));

      try
      {
        $method = 'build' . ucfirst($driver) . 'Dsn';

        if (!method_exists(self::class, $method))
          throw new PDOException("Datenbank-Treiber [{$driver}] wird aktuell nicht unterstützt.");

        $dsn = self::$method(); 
        $user = Config::get('db.username');
        $pass = Config::get('db.password');

        self::$connection = new PDO($dsn, $user, $pass,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
        ]);

      }
      catch (PDOException $e)
      {
        // Hier noch wenn in Produktiv Umgebung Seite einfügen
        dd("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
      }
    }

    return self::$connection;
  }

  public static function disconnect() : void 
  {
    self::$connection = null;
  }

  protected static function select(string $sql, array $params = []) : array
  {
    if (self::$connection === null)
      self::connect();

    $db = self::$connection;
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }

  // Baut den DSN für MariaDB / MySQL
  private static function buildMariadbDsn() : string 
  {
    return self::buildMysqlDsn();
  }
  private static function buildMysqlDsn() : string 
  {
    $host   = Config::get('db.host');
    $port   = Config::get('db.port');
    $name = Config::get('db.database');
    $charset = Config::get('db.charset');
    
    return "mysql:host={$host};port={$port};dbname={$name};charset={$charset}";
  }
}