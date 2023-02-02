<?php
/**
 * This is a PHP code of a class named UsersController that belongs to the namespace App\Controllers
 * The class provides different methods to handle the data from the forms, an static function to get all the data from the database or a method to clean the data
 */

/**
 * Create a namespace
 */
namespace App\Controllers;

/**
 * Start session if there's no one
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/**
 * Use the Users class
 */
use App\Models\Users;

/**
 * Class UsersController
 *
 * A class for handling and clean the data from the form, or listing the records 
 */
class UsersController {
    /**
     * Get and clean the data from the form
     * @param array $data The form data to be cleaned and passing to the model
     * @return void
     */
    public function handler(array $post) : void {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }

        /**
         * @var object $user Instance of the Users class
         */
        $user = new Users();
        /**
         * Depending on the contion, will run one or another method
         */
        if(array_key_exists('signUpUser', $values)) {
            $this->errorsHandler($values['emailSignUp'], $values['passSignup'], $values['repeatPassSignup'], $values['nidSignUp']);

            if($_SESSION['alert']['error']) { 
                return;
            } else {
                // Insertamos los valores en la base de datos con el método insert()
                $user->insert($values);
            }
        }
        elseif(array_key_exists('submitUpUser', $values)) {
            // Insertamos los valores en la base de datos con el método insert()
            $user->update($values);
        } else {
            $user->delete($values['nidDel']);
        }
    }
    
    /**
     * Get and clean the data from the form
     * @param string $email The form data to be cleaned and passing to the model
     * @param string $password The form data to be cleaned and passing to the model
     * @param string $oass The form data to be cleaned and passing to the model
     * @param string $data The form data to be cleaned and passing to the model
     * @return void
     */
    public function errorsHandler(string $email, string $password, string $passwordConfirm, string $dni) : void {
        $_SESSION['alert'] = [
            'error' => false,
            'messages' => []
        ];

        $user = new Users();
        if ($user->selectByEmail($email)) {
            $_SESSION['alert']['error'] = true;
            $_SESSION['alert']['messages'][] = 'El email ya está registrado.';
        }

        if ($user->selectById($dni)) {
            $_SESSION['alert']['error'] = true;
            $_SESSION['alert']['messages'][] = 'El DNI ya está registrado';
        }

        if ($password !== $passwordConfirm) {
            $_SESSION['alert']['error'] = true;
            $_SESSION['alert']['messages'][] = 'Las contraseñas no coinciden.';
        }
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

    /**
     * Retrieve all the data from the booking table
     * @return array
     */     
    public static function getUsersList() : array {
        $users = new Users();

        return $users->selectAll();
    }
}
?>

