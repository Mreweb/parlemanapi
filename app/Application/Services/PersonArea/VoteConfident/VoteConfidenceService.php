<?php

namespace App\Application\Services\PersonArea\VoteConfident;
use App\Domain\Interfaces\PersonArea\VoteConfident\IVoteConfidenceRepository;

class VoteConfidenceService{

    public function __construct(private IVoteConfidenceRepository $repository){}

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
}
