<?php
/**
 * This is a PHP code of a class named Rooms that belongs to the namespace App\Models
 * The class provides different methods to insert, update, delete or select data from the database 
 */

/**
 * Create a namespace
 */
namespace App\Models;

/**
 * Use the Connection class and CrudInterface interface
 */
use App\Models\Connection;
use App\Models\Interfaces\CrudInterface;

/**
 * Class Rooms
 *
 * A class for creating tables from database (if not exists), also selecting data from database, insert new data, update or delete
 */
class Rooms implements CrudInterface {
    /**
     * @var \PDO The database connection
     */
    private $conn;
    /**
     * Class constructor
     * This constructor initializes the class property $conn by calling the static method getInstance on the Connection class and then calling the public method getConnection on the result, thus $conn will content the connection
     * Additionally, it calls the method create on Rooms to create the table if not exists.
    */
    function __construct() {
        $this->conn = Connection::getInstance()->getConnection();
        $this->create();
    }

    /**
     * Inserts a rooms record into the database
     * @param array $data The rooms data to be inserted
     * @return void
     */
    public function insert(array $data) : void {
        $stmt = $this->conn->prepare("INSERT INTO rooms (description, max_capacity, room_type) VALUES (:description, :max_capacity, :room_type)");
        $stmt->bindValue(":description", $data['roomDescriptionSignUp'], \PDO::PARAM_STR); // Hay que poner una contra barra a PDO, porque si no el método entiende que es una estática de la misma clase
        $stmt->bindValue(":max_capacity", $data['maxCapacitySignUp'], \PDO::PARAM_INT);
        $stmt->bindValue(":room_type", $data['roomTypeSignUp'], \PDO::PARAM_STR);
        
        $stmt->execute();
    }

    /**
     * Creates the rooms table in the database if it doesn't exist
     * @return void
     */
    public function create() : void {
        $table = 'CREATE TABLE IF NOT EXISTS rooms(
            id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            description VARCHAR(200) NOT NULL,
            max_capacity INT(2) NOT NULL,
            room_type VARCHAR(50) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )';

        $this->conn->exec($table);
    }

    /**
     * Retrieves all rooms records from the database
     * @return array An array of rooms records
     */
    public function selectAll() : array {
        $query = $this->conn->prepare("SELECT * FROM rooms");
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Retrieves a single room record from the database based on its id
     * @param int $id The id of the rooms
     * @return array An array of rooms records with the same $id
     */
    public function selectById(mixed $id) : array {
        $query = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $query->bindValue(":id", $id, \PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Updates a room record from the database based on its id
     * @param array $data The data retrived from the form
     * @return bool
     */
    public function update(array $data) : bool {
        $query = $this->conn->prepare("UPDATE rooms SET description = :description, max_capacity = :max_capacity, room_type = :room_type WHERE id = :id");

        $query->bindValue(':description', $data['roomDescriptionUp'], \PDO::PARAM_STR);
        $query->bindValue(':max_capacity', $data['maxCapacityUp'], \PDO::PARAM_INT);
        $query->bindValue(':room_type', $data['roomTypeUp'], \PDO::PARAM_STR);
        $query->bindValue(':id', $data['roomIdUpHidden'], \PDO::PARAM_INT);
        
        return $query->execute();
    }
    
    /**
     * Delete a room record from the database based on its id
     * @param int $id The id of the rooms
     * @return bool
     */
    public function delete(int $id) : bool {
        $query = $this->conn->prepare("DELETE FROM rooms WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_STR);
    
        return $query->execute();
    }
}

?>
