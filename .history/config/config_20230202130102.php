<?php

// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Asignar las variables de entorno a variables PHP
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

?>
