<?php

namespace App\Domain\Interfaces\PersonArea\Statement;
use App\Domain\Interfaces\IBaseRepository;

interface IStatementRepository  extends IBaseRepository{

    public function findSinaturesById(int $id);
    public function findWorksheetMedia(int $id);
    public function findAnswerWorksheetMedia(int $id);

}


?>
