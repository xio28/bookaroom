<?php
/**
 * This is a PHP code of a class named LoginController that belongs to the namespace App\Controllers
 * The class provides different methods to validate the data from the forms and a method to clean the data
 */

/**
 * Create a namespace
 */
namespace App\Controllers;
/**
 * Use the Booking class
 */
use App\Models\Login;

/**
 * Class LoginController
 *
 * A class for validating data from the login form
 */
class LoginController {
    /**
     * Get the data from the form
     * @param array $data The form data to be cleaned and passing to the model
     * @return void
     */
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
