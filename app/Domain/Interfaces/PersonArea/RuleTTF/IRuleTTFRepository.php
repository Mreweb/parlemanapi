<?php

namespace App\Domain\Interfaces\PersonArea\RuleTTF;

use App\Domain\Interfaces\IBaseRepository;

interface IRuleTTFRepository  extends IBaseRepository{

    public function findSignaturesById(int $id);

}


?>
