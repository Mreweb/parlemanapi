<?php

namespace App\Domain\Interfaces;

interface IResearchRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function findSignaturesById(int $id);
    public function findTeamById(int $id);
    public function findWorkSheetById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);

}


?>
