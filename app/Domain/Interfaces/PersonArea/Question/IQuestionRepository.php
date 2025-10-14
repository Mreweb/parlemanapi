<?php

namespace App\Domain\Interfaces\PersonArea\Question;

use App\Domain\Interfaces\IBaseRepository;

interface IQuestionRepository  extends IBaseRepository{

    public function findWorksheetMediaById(int $id);
    public function findSignaturesById(int $id);

}


?>
