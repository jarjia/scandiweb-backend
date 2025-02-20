<?php

namespace App\Helpers;

class Config
{
    private static ?Config $instance = null;

    private array $config = [];

    private function __construct()
    {
        $this->load();
    }

    public static function getInstance(): Config
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function load(): void
    {
        foreach (glob(__DIR__ . '/../../config/*.php') as $file) {
            $name = basename($file, '.php');
            $this->config[$name] = require $file;
        }
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $default;
            }
            $value = $value[$k];
        }

        return $value;
    }
}
