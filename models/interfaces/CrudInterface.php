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
    public function create() : void;
    /**
     * Returns an array of all data stored in the data storage.
     * 
     * @return array
     */
    public function selectAll() : array;
    /**
     * Returns the data stored in the data storage with the given ID.
     * 
     * @param mixed $id ID of the data to return.
     * @return array
     */
    public function selectById(mixed $id) : array;
    /**
     * Insert data into the database
     * 
     * @param array $data An array of the data to insert.
     * @return array
     */
    public function insert(array $data) : void;
    /**
     * Update data from the database
     * 
     * @param array $data An array of the data to update.
     * @return bool
     */
    public function update(array $data) : bool;
    /**
     * Delete data from the database based on the ID passed as reference
     * 
     * @param mixed $id ID of the data to delete.
     * @return bool
     */
    public function delete(mixed $id) : bool;
}
    
?>
