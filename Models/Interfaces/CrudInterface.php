<?php
namespace App\Models\Interfaces;

interface CrudInterface {

    public function create() : void;

    public function selectAll() : array;

    public function selectById(mixed $id) : array;

    public function insert(array $data) : void;

    public function update(array $data) : bool;

    public function delete(mixed $id) : bool;
}
    
?>
