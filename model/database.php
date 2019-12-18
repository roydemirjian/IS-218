<?php

class Database {

    private static $username = 'rrd28';
    private static $password = 'donate52';
    private static $dsn = "mysql:host=sql1.njit.edu;dbname=rrd28";
    private static $db;

    private function __construct()
    {
    }

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                    self::$username,
                    self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo $error_message;
                exit();
            }
        }
        return self::$db;
    }


}


?>
