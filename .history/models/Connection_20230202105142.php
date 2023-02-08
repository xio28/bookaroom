<?php

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

    public static function getInstance() : object 

        return self::$instance ??= new self();
        
        // Este método hace lo siguiente: si la clase llamada es una instancia de sí misma, devuélvemela, si no, creala; se basa en el patrón singleton
    }

    // Según el código creado, en la variable privada $conn se está guardando la conexión a la base de datos, por lo que necesitamos invocar esa variable para recibir dicha conexión; la forma de hacer esto es creando un método público que devuelva esa variable
    public function getConnection() {
        return $this->conn;
    }

}


?>
