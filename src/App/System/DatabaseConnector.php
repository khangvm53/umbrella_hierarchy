<?php
namespace App\System;

class DatabaseConnector {

    private $dbConnection = null;

    public function __construct()
    {
        try {
            $this->dbConnection = new \PDO(
                'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8mb4;dbname=' . DB_DATABASE_NAME,
                DB_USERNAME,
                DB_PASSWORD
            );
        } catch (\PDOException $e) {
            trigger_error($e->getMessage());
            exit();
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}
