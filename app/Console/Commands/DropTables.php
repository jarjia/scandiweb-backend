<?php

namespace App\Console\Commands;

use App\Core\Database;
use PDO;
use PDOException;

class DropTables
{
    public function handle(): void
    {
        try {
            $conn = Database::getConnInstance()->getConnection();
            echo $conn->getAttribute(PDO::ATTR_DRIVER_NAME);

            $conn->exec('PRAGMA foreign_keys = OFF');

            $stmt = $conn->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $conn->beginTransaction();

            foreach ($tables as $table) {
                $dropQuery = "DROP TABLE IF EXISTS `$table`";
                $conn->exec($dropQuery);
                echo "Dropped table: $table\n";
            }

            $conn->commit();
        } catch (PDOException $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
                echo "Error: " . $e->getMessage();
            }
        } finally {
            $conn->exec('PRAGMA foreign_keys = ON');
        }
    }
}
