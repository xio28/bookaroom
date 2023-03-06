<?php

namespace App\Models;

require('../config/config.php');

class Connection {
    private $conn;
    private static $instance;

    private function __construct() {
        $this->setConnection();
    }

    private function setConnection() {
        $charset = 'utf8mb4';
        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_DB'];
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $connetion = new \PDO('mysql:host='.$host.';charset='.$charset.'', $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);

            $connetion->exec("CREATE DATABASE IF NOT EXISTS " . $db);
            $connetion->exec("USE " . $db);

            $this->conn = $connetion;
            
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getInstance() : object {
        return self::$instance ??= new self();
    }

    public function getConnection() : object {
        return $this->conn;
    }

}

?>
