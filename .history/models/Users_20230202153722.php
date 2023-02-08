<?php
/**
 * This is a PHP code of a class named Booking that belongs to the namespace App\Models
 * The class provides different methods to insert, update, delete or select data from the database, and also 
 */

/**
 * Create a namespace
 */
namespace App\Models;

/* Importing the classes Connection and CrudInterface */
use App\Models\Connection;
use App\Models\Interfaces\CrudInterface;

class Users implements CrudInterface {
    private $conn;
    
    function __construct() {
        $this->conn = Connection::getInstance()->getConnection();
        $this->create();
    }
    
    public function insert(array $data) : void {
        $stmt = $this->conn->prepare("INSERT INTO users (nid, name, surname1, surname2, email, telephone, password) VALUES (:nid, :name, :surname1, :surname2, :email, :telephone, :password)");
        $stmt->bindValue(":nid", $data['nidSignUp'], \PDO::PARAM_STR); // Hay que poner una contra barra a PDO, porque si no el método entiende que es una estática de la misma clase
        $stmt->bindValue(":name", $data['nameSignUp'], \PDO::PARAM_STR);
        $stmt->bindValue(":surname1", $data['surname1SignUp'], \PDO::PARAM_STR);
        $stmt->bindValue(":surname2", $data['surname2SignUp'], \PDO::PARAM_STR);
        $stmt->bindValue(":email", $data['emailSignUp'], \PDO::PARAM_STR);
        $stmt->bindValue(":telephone", $data['phoneSignUp'], \PDO::PARAM_STR);
        $stmt->bindValue(":password", $data['passSignup'], \PDO::PARAM_STR);
        
        $stmt->execute();
    }

    public function create() : void {
        $table = "CREATE TABLE IF NOT EXISTS users(
            nid VARCHAR(9) NOT NULL PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            surname1 VARCHAR(30) NOT NULL,
            surname2 VARCHAR(30) NULL,
            email VARCHAR(50) NOT NULL,
            telephone VARCHAR(11) NOT NULL,
            password VARCHAR(30) NOT NULL,
            admin BOOLEAN DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $this->conn->exec($table);
    }

    /**
     * Select all users from the database
     * 
     * @return array|bool An array of users or a boolean indicating success or failure
     */
    public function selectAll() : array {
        $query = $this->conn->prepare("SELECT * FROM users");
        $query->execute();

        // In the return annotation ": array" it has been specified that the method will always return an array, but since fetch() can return an array or a boolean, to avoid that, a condition is generated where if fetch() returns false, an empty array will be generated, otherwise it will simply return the array.
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public function selectById($id) : array {
        $query = $this->conn->prepare("SELECT * FROM users WHERE nid=:nid");
        $query->bindValue(":nid", $id, \PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public function selectByEmail($email) : array {
        $query = $this->conn->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindValue(":email", $email, \PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public function update(array $data) : bool {
        $query = $this->conn->prepare("UPDATE users SET name = :name, surname1 = :surname1, surname2 = :surname2, email = :email, telephone = :telephone WHERE nid = :nid");

        $query->bindValue(':nid', $data['nidUp'], \PDO::PARAM_STR);
        $query->bindValue(':name', $data['nameUp'], \PDO::PARAM_STR);
        $query->bindValue(':surname1', $data['surname1Up'], \PDO::PARAM_STR);
        $query->bindValue(':surname2', $data['surname2Up'], \PDO::PARAM_STR);
        $query->bindValue(':email', $data['emailUp'], \PDO::PARAM_STR);
        $query->bindValue(':telephone', $data['telephoneUp'], \PDO::PARAM_STR);
        
        return $query->execute();
    }
    
    public function delete($id) : bool {
        $query = $this->conn->prepare("DELETE FROM users WHERE nid = :nid");
        $query->bindValue(':nid', $id, \PDO::PARAM_STR);
    
        return $query->execute();
    }
}

?>
