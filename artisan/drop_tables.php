<?php

require __DIR__ . "/../bootstrap/app.php";

use App\Console\Commands\DropTables;

$migrationRunner = new DropTables();
$migrationRunner->handle();
