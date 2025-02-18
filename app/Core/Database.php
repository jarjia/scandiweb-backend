<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $conn = null;

    public static function getConnection(): PDO
    {
        if (self::$conn === null) {
            $driver = config('database.driver', 'mysql');
            $host = config('database.host');
            $db = config('database.db');
            $user = config('database.user');
            $password = config('database.password');

            try {
                self::$conn = new PDO("$driver:host=$host;dbname=$db;charset=utf8", $user, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("error" . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
