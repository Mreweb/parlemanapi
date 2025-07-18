<?php

namespace App\Domain\Interfaces\Common\Commission;

interface ICommissionRepository{

    public function list(array $filters);
    public function all();
    public function findById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);
}
