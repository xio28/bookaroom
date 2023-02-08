<?php

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
