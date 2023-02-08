<?php

/**
 * Load the autoload file from composer folder
 */
require '../vendor/autoload.php';

/**
 * @var object The instance of Dotenv 
 */
$dotenv = Dotenv\Dotenv::createImmutable('../includes');
$dotenv->load();

// Asignar las variables de entorno a variables PHP

?>
