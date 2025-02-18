<?php

require __DIR__ . "/../bootstrap/app.php";

use App\Console\Commands\CreateMigration;

$create_migration = new CreateMigration($argv[1]);
$create_migration->handle();
