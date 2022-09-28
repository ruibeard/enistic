<?php

require 'Connection.php';

class QueryBuilder
{
    public ?PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::make();

        // In a real system we should have migrations, seeders to ensure the state of the databse.

        if (!$this->tableExists()) {
            $this->createPricesTable();
            $this->seedTables();
        }
    }

    /**
     * @param $table
     * @param $class
     *
     * @return array|false
     */
    public function fetchAll($table, $class = null)
    {
        $statment = $this->pdo->prepare("select * from {$table}");
        $statment->execute();

        return $statment->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function deleteRecord($table, $id)
    {
        $statment = $this->pdo->prepare("DELETE from {$table} where id = {$id}");
        $statment->execute();
    }

    public function createRecord($description, $price)
    {
        try {
            $sql      = "INSERT INTO prices (description, price ) VALUES (:description, :price)";
            $statment = $this->pdo->prepare($sql);
            $statment->bindParam(":description", $description);
            $statment->bindParam(":price", $price);
            $statment->execute();
        } catch (PDOException $e) {
            echo "error ".$e->getMessage();
        }
    }

    private function tableExists(): bool|PDOStatement
    {
        try {
            return $this->pdo->query("select 1 from prices LIMIT 1");
        } catch (Exception $e) {
            return false;
        }
    }

    private function createPricesTable(): void
    {
        $sql = "CREATE TABLE `prices` ( `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL, `price` decimal(8,2) DEFAULT NULL, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; ";
        $this->pdo->exec($sql);
    }

    private function seedTables()
    {
        $sql = "
                INSERT INTO `prices` (`id`, `description`, `price`, `created_at`, `updated_at`)
                VALUES
                	(1,'Apples',27.00,NULL,NULL),
                	(2,'Oranges',83.00,NULL,NULL),
                	(3,'Bananas',12.00,NULL,NULL);
                ";
        $this->pdo->exec($sql);
    }
}