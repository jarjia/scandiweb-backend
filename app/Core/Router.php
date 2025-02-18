<?php

namespace App\Core;

class Router
{
    private static array $routes = [];

    public static function get(string $route, array $handler): void
    {
        self::$routes[$route] = $handler;
    }

    public static function dispatch(string $method, string $route)
    {
        if (isset(self::$routes[$route])) {
            $handler = self::$routes[$route];

            if (is_array($handler)) {
                $controller = new $handler[0]();
                $method = $handler[1];

                return $controller->$method();
            }
        }

        return '404 - Route not found';
    }
}
