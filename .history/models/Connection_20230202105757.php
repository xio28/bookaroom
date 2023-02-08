<?php

/**
 * This is a PHP code of a class named Connection that belongs to the namespace App\Models
 * The class provides a singleton pattern to create a database connection and reuse it throughout the application
 */
namespace App\Models;

class Connection {

    private $conn;
    private static $instance;

    private function __construct() {
        $this->setConnection();
    }

    private function setConnection() {
        $host = '127.0.0.1';
        $charset = 'utf8mb4';
        $user = 'root';
        $pass = '';
        $db = 'bookaroomDB';

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $connetion = new \PDO("mysql:host=".$host.";charset=".$charset."", $user, $pass, $options);

            $connetion->exec("CREATE DATABASE IF NOT EXISTS " . $db);
            $connetion->exec("use " . $db);

            $this->conn = $connetion;
            
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getInstance() : object {

        return self::$instance ??= new self();
        
    }

    public function getConnection() {
        return $this->conn;
    }

}


?>
