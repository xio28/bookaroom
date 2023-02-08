<?php
/**
 * This is a PHP code of a class named Connection that belongs to the namespace App\Models
 * The class provides a singleton pattern to create a database connection and reuse it throughout the application
 */

/**
 * Create a namespace
 */
namespace App\Models;

/**
 * Load the config file
 */
require('../config/config.php');

/**
 * Class Connection
 *
 * A class for creating and storing a database connection using the singleton pattern
 */
class Connection {
    /**
     * @var \PDO The database connection
     */
    private $conn;
    /**
     * @var object The instance of the class
     */
    private static $instance;

    /**
     * Private constructor to prevent direct instantiation
     *
     * Sets the database connection
     */
    private function __construct() {
        // Cuando instancia la clase te conectas automáticamente a la BBDD
        $this->setConnection();
    }

    /**
     * Private function that sets the database connection
     *
     * Connects to the database using PDO (PHP Data Objects)
     * and creates the database if it doesn't exist
     */
    private function setConnection() {
        /**
         * @var string Default charset to connect to the database
         */
        $charset = 'utf8mb4';
        /**
         * @var string An environment variable that have stored the host
         */
        $host = $_ENV['DB_HOST'];
        /**
         * @var string An environment variable that have stored the database name
         */
        $db = $_ENV['DB_DB'];

        /**
         * @var array An array that contains optional configurations for PDO connection
         */
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];

        /**
         * This statement try to connect to the database, create if not exists and use it
         * @var object Instance the PDO class
         * @throws PDOException If there is and error when database is connecting or is bren created
         */
        try {
            $connetion = new \PDO('mysql:host='.$host.';charset='.$charset.'', $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);

            $connetion->exec("CREATE DATABASE IF NOT EXISTS " . $db);
            $connetion->exec("use " . $db);

            $this->conn = $connetion;
            
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    /**
     * Private static this function, based on Singleton design pattern, checks if the instance created it's a itself instance
     *
     * @return object The instance of this class
     */
    public static function getInstance() : object {

        return self::$instance ??= new self();
    }

    // Según el código creado, en la variable privada $conn se está guardando la conexión a la base de datos, por lo que necesitamos invocar esa variable para recibir dicha conexión; la forma de hacer esto es creando un método público que devuelva esa variable
    public function getConnection() {
        return $this->conn;
    }

}


?>
