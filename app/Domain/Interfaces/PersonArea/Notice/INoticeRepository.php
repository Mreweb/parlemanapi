<?php

namespace App\Domain\Interfaces\PersonArea\Notice;

use App\Domain\Interfaces\IBaseRepository;

interface INoticeRepository  extends IBaseRepository{

    public function findSinaturesById(int $id);
    public function findWorksheetMedia(int $id);
    public function findAnswerWorksheetMedia(int $id);

}


?>
