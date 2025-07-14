<?php

namespace App\Application\Services;

use App\Infrastructure\Persistence\Repositories\Meeting\MeetingRepository;

class MeetingService{

    public function __construct(private MeetingRepository $repository){}

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
    public function add_meeting_track(array $data)
    {
        return $this->repository->add_meeting_track($data);
    }
    public function update_meeting_track(array $data)
    {
        return $this->repository->update_meeting_track($data);
    }
    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
