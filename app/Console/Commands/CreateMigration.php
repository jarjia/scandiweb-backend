<?php

namespace App\Console\Commands;

class CreateMigration
{
    private $argument;

    public function __construct(string $argument)
    {
        $this->argument = $argument;
    }

    public function handle(): void
    {
        $date = date('Ymd_His');
        $filename = "{$date}_{$this->argument}.php";
        $filepath = __DIR__ . "/../../../database/migrations/{$filename}";

        $template = <<<PHP
        <?php \n
        PHP;

        file_put_contents($filepath, $template);
        echo "Migration crated: {$filename}\n";
    }
}
