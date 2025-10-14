<?php

namespace App\Domain\Interfaces\PersonArea\VoteConfident;

use App\Domain\Interfaces\IBaseRepository;

interface IVoteConfidenceRepository  extends IBaseRepository{

    public function findOpposingById(int $id);
    public function findSupportersById(int $id);

}


?>
