<?php
/**
 * This is a PHP code of a class named RoomsController that belongs to the namespace App\Controllers
 * The class provides different methods to handle the data from the forms, an static function to get all the data from the database or a method to clean the data
 */

/**
 * Create a namespace
 */
namespace App\Controllers;
/**
 * Use the Rooms class
 */
use App\Models\Rooms;

/**
 * Class RoomsController
 *
 * A class for handling and clean the data from the form, or listing the records 
 */
class RoomsController {
    /**
     * Get and clean the data from the form
     * @param array $data The form data to be cleaned and passing to the model
     * @return void
     */
    public function handler(array $post) {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }

        // Crear una instancia de la clase Users
        $room = new Rooms();
        /**
         * Depending on the contion, will run one or another method
         */
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
     * Retrieve all the data from the rooms table
     * @return array
     */
    public static function getRoomsList() {
        $rooms = new Rooms();

        return $rooms->selectAll();
    }
}
?>

