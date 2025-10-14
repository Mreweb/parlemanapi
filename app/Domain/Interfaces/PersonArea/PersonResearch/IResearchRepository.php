<?php

namespace App\Domain\Interfaces\PersonArea\PersonResearch;

use App\Domain\Interfaces\IBaseRepository;

interface IResearchRepository  extends IBaseRepository{

    public function findSignaturesById(int $id);
    public function findTeamById(int $id);

}


?>
