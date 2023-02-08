<?php
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

        private function sanitize($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            
            return $data;
        }
        
        public static function getRoomsList() {
            $rooms = new Rooms();

            return $rooms->selectAll();
        }
    }
?>

