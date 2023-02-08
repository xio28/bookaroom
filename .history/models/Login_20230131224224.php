<?php

namespace App\Models;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Models\Connection;
use App\Models\Users;

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
