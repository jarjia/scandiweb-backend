<?php

namespace App\Core;

require __DIR__ . "/../../bootstrap/app.php";

use App\Helpers\Config;
use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private ?PDO $conn = null;

    public function __construct()
    {
        $config = Config::getInstance();

        $driver = $config->get('database.driver', 'mysql');
        $host = $config->get('database.host', 'localhost');
        $db = $config->get('database.db');
        $user = $config->get('database.user');
        $password = $config->get('database.password');

        try {
            $this->conn = new PDO("$driver:host=$host;dbname=$db;charset=utf8", $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("error" . $e->getMessage());
        }
    }

    public static function getConnInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
