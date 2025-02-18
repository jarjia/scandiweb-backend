<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use PDOStatement;

abstract class Base
{
    protected static string $table = '';

    public static function whereQuery(string $column, mixed $value): PDOStatement | false
    {
        $pdo = self::getConnection();
        $sql = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE $column = :value");
        $sql->bindParam(':value', $value);
        $sql->execute();

        return $sql;
    }

    protected static function getConnection(): PDO
    {
        return Database::getConnection();
    }

    public static function get(): array
    {
        $pdo = self::getConnection();
        $sql = $pdo->query("SELECT * FROM " . static::$table);

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function firstWhere(string $column, mixed $value): array
    {
        $sql = self::whereQuery($column, $value);

        return $sql ? ($sql->fetch(PDO::FETCH_ASSOC) ?: null) : null;
    }

    public static function where(string $column, mixed $value): array
    {
        $sql = self::whereQuery($column, $value);

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): bool
    {
        $pdo = self::getConnection();
        $keys = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO " . static::$table . " ($keys) VALUES ($values)";
        $sql = $pdo->prepare($sql);

        foreach ($data as $key => $val) {
            $sql->bindValue(":$key", $val);
        }

        return $sql->execute();
    }

    public static function createAll(array $data): bool
    {
        $pdo = self::getConnection();

        $keys = implode(", ", array_keys($data[0]));
        $placeholders = ":" . implode(", :", array_keys($data[0]));

        $sql = "INSERT INTO " . static::$table . " ($keys) VALUES ($placeholders)";
        $stmt = $pdo->prepare($sql);

        foreach ($data as $row) {
            if (!$stmt->execute($row)) {
                return false;
            }
        }

        return true;
    }
}
