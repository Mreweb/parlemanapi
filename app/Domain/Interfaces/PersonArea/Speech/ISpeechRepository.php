<?php

namespace App\Domain\Interfaces\PersonArea\Speech;
use App\Domain\Interfaces\IBaseRepository;

interface ISpeechRepository  extends IBaseRepository{

    public function findSinaturesById(int $id);
    public function findWorksheetMedia(int $id);
    public function findAnswerWorksheetMedia(int $id);

}


?>
