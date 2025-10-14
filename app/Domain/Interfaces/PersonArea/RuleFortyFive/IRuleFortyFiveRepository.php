<?php

namespace App\Domain\Interfaces\PersonArea\RuleFortyFive;

use App\Domain\Interfaces\IBaseRepository;

interface IRuleFortyFiveRepository  extends IBaseRepository{

    public function findSignaturesById(int $id);

}


?>
