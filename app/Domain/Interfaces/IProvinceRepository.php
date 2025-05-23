<?php

namespace App\Domain\Interfaces;

interface IProvinceRepository {

    public function list(array $filters, int $perPage);
    public function findById(int $id);
    public function get_cities(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);

}


?>
