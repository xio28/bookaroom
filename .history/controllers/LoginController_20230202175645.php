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
 * Use the Login class
 */
use App\Models\Login;

/**
 * Class LoginController
 *
 * A class for validating data from the login form
 */
class LoginController {
    /**
     * Clean and validate the data from the form
     * @param array $data The form data to be cleaned and passing to the model
     * @return void
     */
    public function validateLogin(array $post) : void {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }

        /**
         * @var object $login Instance of the Login class
         */
        $login = new Login();

        $login->checkCredentials($values);
    }
    
    /**
     * Clean the data removing blank spaces or special characters
     * @param string $data The data retrieved from the form
     * @return string
     */
    private function sanitize(string $data) : string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
}
?>
