<?php

namespace App\Application\Services;
use App\Infrastructure\Persistence\Repositories\SessionDeputyGovernor\SessionDeputyGovernorRepository;

class SessionDeputyGovernorService{

    public function __construct(private SessionDeputyGovernorRepository $repository){}

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

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function add_approval(array $data)
    {
        return $this->repository->add_approval($data);
    }
    public function update_approval(array $data)
    {
        return $this->repository->update_approval($data);
    }

    public function add_action(array $data)
    {
        return $this->repository->add_action($data);
    }
    public function update_action(array $data)
    {
        return $this->repository->update_action($data);
    }

}
