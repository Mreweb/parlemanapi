<?php

namespace App\Domain\Interfaces\Common\Country;

use App\Domain\Interfaces\IBaseRepository;

interface IProvinceRepository  extends IBaseRepository{

    public function get_cities(int $id);

}

?>
