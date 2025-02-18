<?php

namespace App\Console\Commands;

use App\Core\Database;

class Migrate
{
    private string $migrationsPath;

    public function __construct()
    {
        $this->migrationsPath = __DIR__ . '/../../../database/migrations';
    }

    public function handle(): void
    {
        $conn = Database::getConnection();
        $files = scandir($this->migrationsPath);
        $files = array_filter($files, fn($file) => $file !== '.' && $file !== '..');

        usort($files, fn($a, $b) => strcmp($a, $b));

        foreach ($files as $file) {
            $filePath = $this->migrationsPath . '/' . $file;
            $query = include($filePath);

            if ($query && $conn->query($query)) {
                echo "Table '{$file}' created successfully.\n";
            } else {
                echo "Error creating '{$file}': " . $conn->errorInfo()[2] . "\n";
            }
        }
    }
}
