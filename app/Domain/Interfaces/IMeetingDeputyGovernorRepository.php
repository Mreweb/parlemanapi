<?php

namespace App\Domain\Interfaces;

interface IMeetingDeputyGovernorRepository {

    public function list(array $filters);
    public function findById(int $id);
    public function findActionsById(int $id);
    public function findApprovalsById(int $id);
    public function findBoardById(int $id);
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);
    public function add_approval(array $data);
    public function update_approval(array $data);
    public function add_action(array $data);
    public function update_action(array $data);

}


?>
