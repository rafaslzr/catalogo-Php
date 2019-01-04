<?php

abstract class PodencoDB {
  //private static $server = 'localhost';
  //private static $db = '';
  //private static $user = '';
  //private static $password = '';
  private static $server = '';
  private static $db = '';
  private static $user = '';
  private static $password = '';

  public static function connectDB() {
    try {
      $connection = new PDO("mysql:host=".self::$server.";dbname=".self::$db.";charset=utf8", self::$user, self::$password);
    } catch (PDOException $e) {
      echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
      die ("Error: " . $e->getMessage());
    }
 
    return $connection;
  }
}
