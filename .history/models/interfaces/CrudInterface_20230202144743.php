<?php
/**
 * This is a PHP code of a class named Booking that belongs to the namespace App\Models
 * The class provides different methods to insert, update, delete or select data from the database, and also 
 */

/**
 * Create a namespace
 */
namespace App\Models\Interfaces;

interface CrudInterface {
    public function create();
    public function selectAll();
    public function selectById(int $id);
    public function insert(array $data);
    public function update(array $data);
    public function delete(int $id);
}
    
?>
