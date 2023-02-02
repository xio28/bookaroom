<?php
/**
 * This is a PHP code of a class named Login that belongs to the namespace App\Models
 * The provides a single public method which check the credentials from the database comparing them to the email and password gotten from the Controller
 */

/**
 * Create a namespace
 */
namespace App\Models;

/**
 * Start session if there's no one
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/**
 * Use the Connection class and Users
 */
use App\Models\Connection;
use App\Models\Users;

/**
 * Class Booking
 *
 * A class for creating tables from database (if not exists), also selecting data from database, insert new data, update or delete
 */
class Login {

    private $conn;

    function __construct() {
        $this->conn = Connection::getInstance()->getConnection();
    }

    public function checkCredentials(array $data) : bool {
        // Check if email and password are correct 
        $user = new Users();
        $credentials = $user->selectByEmail($data['emailLogin']);

        if(count($credentials) > 0) {
            if($data['emailLogin'] === $credentials['email'] && $data['passLogin'] === $credentials['password']) {
                $_SESSION['login'] = [
                    'nid' => $credentials['nid'],
                    'admin' => $credentials['admin']
                ];
                return true; 
            } else {
                return false; 
            } 
        } else {
            return false;
        }
    }

}

?>
