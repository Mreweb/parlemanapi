<?php

namespace App\Application\Services;

use App\Infrastructure\Persistence\Repositories\Ministry\MinistryRepository;

class MinistryService{

    public function __construct(private MinistryRepository $repository){}

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
