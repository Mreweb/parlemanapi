<?php

namespace App\Domain\Interfaces;
interface IMeetingRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function add_meeting_track(array $data);
    public function update_meeting_track(array $data);
    public function delete(int $id);

}


?>
