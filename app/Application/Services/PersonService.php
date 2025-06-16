<?php

namespace App\Application\Services;

use App\Infrastructure\Persistence\Repositories\Person\PersonRepository;

class PersonService{

    public function __construct(private PersonRepository $repository){}

    public function list(array $filters){
        return $this->repository->list($filters);
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
    public function update_fraction(array $data)
    {
        return $this->repository->update_fraction($data);
    }
    public function update_election(array $data)
    {
        return $this->repository->update_election($data);
    }
    public function update_commission(array $data)
    {
        return $this->repository->update_commission($data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
