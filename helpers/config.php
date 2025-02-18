<?php

$env = file_get_contents(__DIR__ . "/../.env");
$lines = explode("\n", $env);

foreach ($lines as $line) {
    preg_match("/([^#]+)\=(.*)/", $line, $matches);
    if (isset($matches[2])) {
        putenv(trim($line));
    }
}

function config(string $key, $default = null): mixed
{
    static $config = [];

    foreach (glob(__DIR__ . '/../config/*.php') as $file) {
        $realPath = realpath($file);
        $name = basename($file, '.php');
        $config[$name] = require $realPath;
    }

    $keys = explode('.', $key);
    $value = $config;

    foreach ($keys as $k) {
        if (!isset($value[$k])) {
            return $default;
        }
        $value = $value[$k];
    }

    return $value;
}
