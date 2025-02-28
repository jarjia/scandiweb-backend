<?php

use App\Core\Router;

require __DIR__ . '/../bootstrap/app.php';
require __DIR__ . '/../routes/api.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

Router::dispatch($_SERVER['REQUEST_METHOD'], $route);
