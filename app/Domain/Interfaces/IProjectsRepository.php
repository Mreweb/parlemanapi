<?php

namespace App\Domain\Interfaces;

interface IProjectsRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);
    public function findParticipationById(int $id);
    public function findRelatedCommissionById(int $id);
    public function findSpecialById(int $id);

}


?>
