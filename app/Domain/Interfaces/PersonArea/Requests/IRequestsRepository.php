<?php

namespace App\Domain\Interfaces\PersonArea\Requests;

use App\Domain\Interfaces\IBaseRepository;

interface IRequestsRepository  extends IBaseRepository{

    public function add_track(array $data);
    public function getTracById(int $id);
    public function update_track(array $data);
    public function delete_track(int $id);

}


?>
