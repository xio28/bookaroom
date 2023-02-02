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
    public function handler($post) {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }

        // var_dump($values);
        // Ejecutamos el manejador de errores y le pasamos el DNI, el email, la contraseña y su confirmación

        // Crear una instancia de la clase Users
        $user = new Users();

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
    
    public function errorsHandler($email, $password, $passwordConfirm, $dni) {
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

    private function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
            
    public static function getUsersList() {
        $users = new Users();

        return $users->selectAll();
    }
}
?>

