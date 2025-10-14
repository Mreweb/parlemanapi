<?php

namespace App\Domain\Interfaces\PersonArea\Projects;

use App\Domain\Interfaces\IBaseRepository;

interface IProjectsRepository  extends IBaseRepository{

    public function findParticipationById(int $id);
    public function findRelatedCommissionById(int $id);
    public function findSpecialById(int $id);

}


?>
