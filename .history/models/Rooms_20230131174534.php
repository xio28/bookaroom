<?php

namespace App\Models;

use App\Models\Connection;
use App\Models\Interfaces\CrudInterface;

class Rooms implements CrudInterface {
    private $conn;

    function __construct() {
        $this->conn = Connection::getInstance()->getConnection();
        $this->create();
    }

    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO rooms (description, max_capacity, room_type) VALUES (:description, :max_capacity, :room_type)");
        $stmt->bindValue(":description", $data['roomDescriptionSignUp'], \PDO::PARAM_STR); // Hay que poner una contra barra a PDO, porque si no el método entiende que es una estática de la misma clase
        $stmt->bindValue(":max_capacity", $data['maxCapacitySignUp'], \PDO::PARAM_INT);
        $stmt->bindValue(":room_type", $data['roomTypeSignUp'], \PDO::PARAM_STR);
        
        $stmt->execute();
    }

    public function create() {
        $table = 'CREATE TABLE IF NOT EXISTS rooms(
            id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            description VARCHAR(200) NOT NULL,
            max_capacity INT(2) NOT NULL,
            room_type VARCHAR(50) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )';

        $this->conn->exec($table);
    }

    public function selectAll() : array {
        $query = $this->conn->prepare("SELECT * FROM rooms");
        $query->execute();

        return $query->fetchAll();
    }

    public function selectById($id) : bool {
        $query = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $query->bindValue(":id", $id, \PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function update(array $data) : bool {
        $query = $this->conn->prepare("UPDATE rooms SET description = :description, max_capacity = :max_capacity, room_type = :room_type WHERE id = :id");

        $query->bindValue(':description', $data['roomDescriptionUp'], \PDO::PARAM_STR);
        $query->bindValue(':max_capacity', $data['maxCapacityUp'], \PDO::PARAM_INT);
        $query->bindValue(':room_type', $data['roomTypeUp'], \PDO::PARAM_STR);
        $query->bindValue(':id', $data['roomIdUpHidden'], \PDO::PARAM_INT);
        
        return $query->execute();
    }
    
    public function delete($id) : bool {
        $query = $this->conn->prepare("DELETE FROM rooms WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_STR);
    
        return $query->execute();
    }
}

?>
