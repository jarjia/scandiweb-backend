<?php

namespace App\Helpers;

use GraphQL\Type\Definition\Type;

class TypeRegistry
{
    private static array $types = [];

    public static function get(string $name, callable $callback = null): Type
    {
        if (!isset(self::$types[$name])) {
            self::$types[$name] = $callback();
        }
        return self::$types[$name];
    }
}
