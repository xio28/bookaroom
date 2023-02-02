<?php
/**
 * This is a PHP code of a class named LoginController that belongs to the namespace App\Controllers
 * The class provides different methods to handle the data from the forms, an static function to get all the data from the database or a method to clean the data
 */

/**
 * Create a namespace
 */
namespace App\Controllers;

use App\Models\Login;

class LoginController {

    public function validateLogin($post) {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }

        // Crear una instancia de la clase Login
        $login = new Login();

        $login->checkCredentials($values);
    }

    private function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
}
?>
