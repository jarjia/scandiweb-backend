<?php

require __DIR__ . "/../vendor/autoload.php";

$envPath = __DIR__ . '/../.env';

if (!file_exists($envPath)) {
    return;
}

$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    if (preg_match('/([^#]+)=(.*)/', $line, $matches)) {
        putenv(trim($line));
    }
}
