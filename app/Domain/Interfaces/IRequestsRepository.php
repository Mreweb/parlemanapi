<?php

namespace App\Domain\Interfaces;

interface IRequestsRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);
    public function add_track(array $data);
    public function getTracById(int $id);
    public function update_track(array $data);
    public function delete_track(int $id);

}


?>
