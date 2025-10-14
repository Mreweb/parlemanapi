<?php

namespace App\Domain\Interfaces\PersonArea\Meeting;
use App\Domain\Interfaces\IBaseRepository;

interface IMeetingRepository  extends IBaseRepository{

    public function add_meeting_track(array $data);
    public function update_meeting_track(array $data);
    public function get_meeting_track(int $id);

}


?>
