<?php

class Database
{
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $pdo;

    public function __construct()
    {
        echo "Loading Database configuration<br>";
        $config = require __DIR__ . '/../../config/config.php';
        $this->host = $config['db']['host'];
        $this->dbname = $config['db']['dbname'];
        $this->user = $config['db']['user'];
        $this->password = $config['db']['password'];

        $this->connect();
    }

    private function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Database connection established<br>";
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
