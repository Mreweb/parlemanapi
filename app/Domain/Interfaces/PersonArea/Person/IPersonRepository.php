<?php

namespace App\Domain\Interfaces\PersonArea\Person;
use App\Domain\Interfaces\IBaseRepository;
interface IPersonRepository extends IBaseRepository{

    public function findByField($field, $value);
    public function get_all_info(int $id);
    public function update_fraction(array $data);
    public function update_election(array $data);
    public function update_commission(array $data);

}
?>
