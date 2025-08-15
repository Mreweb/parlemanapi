<?php

namespace App\Application\Services\Common\PerlemanPeriod;


use App\Domain\Interfaces\Common\PerlemanPeriod\IParlemanPeriodRepository;

class ParlemanPeriodService{

    public function __construct(private IParlemanPeriodRepository $repository){}

    public function list(array $filters){
        return $this->repository->list($filters);
    }
    public function all(){
        return $this->repository->all();
    }

    public function get(int $id)
    {
        return $this->repository->findById($id);
    }
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(array $data)
    {
        return $this->repository->update($data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
