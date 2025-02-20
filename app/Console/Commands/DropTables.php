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

            $conn->exec('SET FOREIGN_KEY_CHECKS = 0');

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
            $conn->exec("SET FOREIGN_KEY_CHECKS = 1");
        }
    }
}
