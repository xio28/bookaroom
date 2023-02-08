<?php
/**
 * This file displays the admin panel
 *
 * The header and footer partials are required, and the header is created with the title "Panel de administrador"
 * Have several modals for insert, update and delete; rooms can be inserted through a modal form as well as updated or deleted and users and reservations can be deleted or updated
 * The page have several tables that displays through loops the database queries of each table: rooms, booking and users
 * The footer is also created
 */
namespace App\Models;

use App\Models\Connection;
use App\Models\Interfaces\CrudInterface;

class Booking implements CrudInterface {

    private $conn;

    function __construct() {
        // Esto es un singleton -> Básicamente, 
        $this->conn = Connection::getInstance()->getConnection();
        $this->create();
    }

    public function insert($data) : void {
        $table = get_class($this);
        $stmt = $this->conn->prepare("INSERT INTO booking (user_nid, room_id, check_in, check_out) VALUES (:user_nid, :room_id, :check_in, :check_out)");
        $stmt->bindValue(":user_nid", $data['bookRoomNid'], \PDO::PARAM_STR); // Hay que poner una contra barra a PDO, porque si no el método entiende que es una estática de la misma clase
        $stmt->bindValue(":room_id", intval($data['bookRoomRId']), \PDO::PARAM_INT);
        $stmt->bindValue(":check_in", $data['bookRoomCheckIn'], \PDO::PARAM_STR);
        $stmt->bindValue(":check_out", $data['bookRoomCheckOut'], \PDO::PARAM_STR);
        
        $stmt->execute();
    }

    public function create() : void {
        $table = "CREATE TABLE IF NOT EXISTS booking(
            book_id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_nid VARCHAR(9) NOT NULL,
            room_id INT(3) NOT NULL,
            check_in DATE NOT NULL,
            check_out DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        
            CONSTRAINT `fk1_booking_user`
                FOREIGN KEY (`user_nid`) REFERENCES users (`nid`)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
        
            CONSTRAINT `fk2_booking_room`
                FOREIGN KEY (`room_id`) REFERENCES rooms (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE
        )";

        $this->conn->exec($table);
    }

    public function selectAll() {
        $query = $this->conn->prepare("SELECT * FROM booking");
        $query->execute();

        return $query->fetchAll();
    }

    public function selectById($id) {
        $query = $this->conn->prepare("SELECT * FROM booking WHERE book_id=:book_id");
        $query->bindValue(":book_id", $id, \PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }


    public function update(array $data) :bool {
        $query = $this->conn->prepare("UPDATE booking SET room_id = :room_id, check_in = :check_in, check_out = :check_out WHERE book_id = :book_id");
        
        $data['roomNumUpBooking'] = intval($data['roomNumUpBooking']);
        $query->bindValue(':book_id', $data['bookingIdUpHidden'], \PDO::PARAM_INT);
        $query->bindValue(':room_id', $data['roomNumUpBooking'], \PDO::PARAM_INT);
        $query->bindValue(':check_in', $data['checkInUpBooking'], \PDO::PARAM_STR);
        $query->bindValue(':check_out', $data['checkInOutBooking'], \PDO::PARAM_STR);
        
        return $query->execute();
    }
    
    public function delete($id) : bool {
        $query = $this->conn->prepare("DELETE FROM booking WHERE book_id = :book_id");
        // $data['roomNumUpBooking'] = intval($data['roomNumUpBooking']);
        $query->bindValue(':book_id', $id, \PDO::PARAM_STR);
    
        return $query->execute();
    }

}

?>
