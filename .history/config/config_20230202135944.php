<?php

/**
 * Load the autoload file from composer folder
 */
require '../vendor/autoload.php';

/**
 * @var object The instance of Dotenv class
 */
$dotenv = Dotenv\Dotenv::createImmutable('../includes');
/**
 * Load the 
 */
$dotenv->load();

// Asignar las variables de entorno a variables PHP

?>
