<?php

namespace App\Domain\Interfaces\PersonArea\Interpellation;

use App\Domain\Interfaces\IBaseRepository;

interface IInterpellationsRepository  extends IBaseRepository{

    public function findOpposingPersonById(int $id);
    public function findSupportersPersonById(int $id);
    public function findOptPersonById(int $id);
    public function findReturnOptPersonById(int $id);
    public function findSignaturesPersonById(int $id);
    public function findWorksheetMediaPersonById(int $id);
    public function findCorrespondenceWorksheetMediaPersonById(int $id);

}


?>
