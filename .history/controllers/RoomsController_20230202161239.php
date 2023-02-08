<?php
/**
 * This is a PHP code of a class named RoomsController that belongs to the namespace App\Controllers
 * The class provides different methods to handle the data from the forms, an static function to get all the data from the database or a method to clean the data
 */

/**
 * Create a namespace
 */
namespace App\Controllers;

use App\Models\Rooms;

class RoomsController {

    public function handler($post) {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }

        // var_dump($values);
        // Crear una instancia de la clase Users
        $room = new Rooms();

        if(array_key_exists('signUpRoom', $values)) {
            // Insertamos los valores en la base de datos con el método insert()
            $room->insert($values);
        }
        elseif(array_key_exists('submitUpRoom', $values)) {
            $room->update($values);
        } else {
            $room->delete($values['roomDel']);
        }
    }
    /**
     * Clean the data removing blank spaces or special characters
     * @param string $data The data retrieved from the form
     * @return array
     */
    private function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
    /**
     * Retrieve all the data from the booking table
     * @return array
     */
    public static function getRoomsList() {
        $rooms = new Rooms();

        return $rooms->selectAll();
    }
}
?>

