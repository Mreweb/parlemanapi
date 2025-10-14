<?php

namespace App\Domain\Interfaces\BossErea\MeetingDeputy;

use App\Domain\Interfaces\IBaseRepository;

interface IMeetingDeputyGovernorRepository  extends IBaseRepository{

    public function findActionsById(int $id);
    public function findApprovalsById(int $id);
    public function findBoardById(int $id);
    public function add_approval(array $data);
    public function update_approval(array $data);
    public function add_action(array $data);
    public function update_action(array $data);

}


?>
