<?php

namespace App\Configs;

// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Asignar las variables de entorno a variables PHP
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

?>
