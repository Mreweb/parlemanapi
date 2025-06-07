<?php

namespace App\Domain\Interfaces;

interface IPersonRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function findByField($field, $value);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);
    public function update_fraction(array $data);
    public function update_election(array $data);
    public function update_commission(array $data);

}


?>
