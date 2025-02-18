<?php

require __DIR__ . "/../bootstrap/app.php";

use App\Console\Commands\Migrate;

$migrationRunner = new Migrate();
$migrationRunner->handle();
