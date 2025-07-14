<?php

namespace App\Domain\Interfaces;

interface INoticeRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function findSinaturesById(int $id);
    public function findWorksheetMedia(int $id);
    public function findAnswerWorksheetMedia(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);

}


?>
