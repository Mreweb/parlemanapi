<?php

namespace App\Application\Services\Common\President;

use App\Domain\Interfaces\Common\President\IPresidentRepository;

class PresidentService{

    public function __construct(private IPresidentRepository $repository){}

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
