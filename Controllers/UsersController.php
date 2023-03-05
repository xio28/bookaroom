<?php
namespace App\Controllers;

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Models\Users;

class UsersController {

    public function handler(array $post) : void {
        foreach($post as $key => $val) {
            $values[$key] = $this->sanitize($val);
        }
        
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

    public function errorsHandler(string $email, string $password, string $passwordConfirm, string $nid) : void {
        $_SESSION['alert'] = [
            'error' => false,
            'messages' => []
        ];

        $user = new Users();
        if ($user->selectByEmail($email)) {
            $_SESSION['alert']['error'] = true;
            $_SESSION['alert']['messages'][] = 'El email ya está registrado.';
        }

        if ($user->selectById($nid)) {
            $_SESSION['alert']['error'] = true;
            $_SESSION['alert']['messages'][] = 'El DNI ya está registrado';
        }

        if ($password !== $passwordConfirm) {
            $_SESSION['alert']['error'] = true;
            $_SESSION['alert']['messages'][] = 'Las contraseñas no coinciden.';
        }
    }

    private function sanitize(string $data) : string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    public static function getUsersList() : array {
        $users = new Users();

        return $users->selectAll();
    }
}
?>

