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
     * Sets the database connection
     *
     * Connects to the database using PDO (PHP Data Objects)
     * and creates the database if it doesn't exist
     * @var string Default charset to connect to database
     * @var string Default charset to connect to database
     */
    private function setConnection() {
        /**
         * @var string Default charset to connect to database
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

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];

        /**
         * @throws PDOException If there is and error when database is connecting or is creating
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

    public static function getInstance() : object { // El self significa que el método retornará un objeto de la clase a la que pertenece
        // Básicamente, este método funciona de esta forma: Llamas a la clase $connection->getInstance() y este comprueba si ya tiene una instancia creada, si no, la crea y devuelve, si sí la tiene, simplemente la devuelve

        return self::$instance ??= new self(); // Usando el operador de asignación "??=", comprobamos si lo que está a la izquierda tiene algún valor o es null, si ya tiene un valor, se quedará tal cual, pero si no, se creará uno nuevo "new self()"
        
        // Este método hace lo siguiente: si la clase llamada es una instancia de sí misma, devuélvemela, si no, creala; se basa en el patrón singleton
    }

    // Según el código creado, en la variable privada $conn se está guardando la conexión a la base de datos, por lo que necesitamos invocar esa variable para recibir dicha conexión; la forma de hacer esto es creando un método público que devuelva esa variable
    public function getConnection() {
        return $this->conn;
    }

}


?>
