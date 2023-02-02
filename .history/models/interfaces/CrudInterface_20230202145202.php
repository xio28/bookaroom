<?php
/**
 * This is a PHP code of an interface named CrudInterface that belongs to the namespace App\Models\Interfaces
 * The interface provides different methods to insert, update, delete, create, etc. that will be implements in other clases
 */

/**
 * Create a namespace
 */
namespace App\Models\Interfaces;

/**
 * CrudInterface provides a set of methods for performing CRUD operations on data storage.
 */
interface CrudInterface {
    /**
     * Creates a new data storage.
     * 
     * @return void
     */
    public function create();
    public function selectAll();
    public function selectById(int $id);
    public function insert(array $data);
    public function update(array $data);
    public function delete(int $id);
}
    
?>
