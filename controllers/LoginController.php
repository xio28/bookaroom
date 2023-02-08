<?php

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

        private function sanitize(string $data) : string {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            
            return $data;
        }
    }
?>
