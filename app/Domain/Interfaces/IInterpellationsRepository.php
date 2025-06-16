<?php

namespace App\Domain\Interfaces;

interface IInterpellationsRepository {

    public function list(array $filters);
    public function findById(int $id);

    public function findOpposingPersonById(int $id);
    public function findSupportersPersonById(int $id);
    public function findOptPersonById(int $id);
    public function findReturnOptPersonById(int $id);
    public function findSignaturesPersonById(int $id);
    public function findWorksheetMediaPersonById(int $id);
    public function findCorrespondenceWorksheetMediaPersonById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);

}


?>
