<?php

namespace App\Application\Services\PersonArea\Requests;
use App\Domain\Interfaces\PersonArea\Requests\IRequestsRepository;

class RequestsService{

    public function __construct(private IRequestsRepository $repository){}

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


    public function add_track(array $data)
    {
        return $this->repository->add_track($data);
    }
    public function update_track(array $data)
    {
        return $this->repository->update_track($data);
    }
    public function delete_track(int $id)
    {
        return $this->repository->delete_track($id);
    }



}
