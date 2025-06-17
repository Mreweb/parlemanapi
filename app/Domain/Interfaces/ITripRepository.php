<?php

namespace App\Domain\Interfaces;

interface ITripRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function findActionsById(int $id);
    public function findApprovalsById(int $id);
    public function findBoardById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);

}


?>
