<?php

namespace App\Domain\Interfaces;

interface IPresidentRepository{

    public function list(array $filters, int $perPage);
    public function findById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);
}
