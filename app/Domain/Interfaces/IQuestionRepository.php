<?php

namespace App\Domain\Interfaces;

interface IQuestionRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);

}


?>
