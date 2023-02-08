<?php

/**
 * Load the autoload file from composer folder
 */
require '../vendor/autoload.php';

/**
 * @var object 
 */
$dotenv = Dotenv\Dotenv::createImmutable('../includes');
$dotenv->load();

// Asignar las variables de entorno a variables PHP

?>
