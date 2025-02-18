<?php

require __DIR__ . "/../bootstrap/app.php";

use Database\Seed\Seeder;

if (!isset($argv[1])) {
    echo "Api url parameter is required, put url in quotes!" . "\n";
    exit;
}

$seeder = new Seeder();
$seeder->handle($argv[1]);
