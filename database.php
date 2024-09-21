<?php

// Database Class ------------------------------------------ 
class Database {
    private $host = 'localhost';
    private $dbname = 'dbtest';
    private $user = 'root';
    private $pass = '';

    private $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname:{$this->dbname}";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        public function getConnection() {
            return $this->pdo;
        }

    }
}

?>
