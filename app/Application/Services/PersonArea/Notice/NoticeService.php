<?php

namespace App\Application\Services\PersonArea\Notice;
use App\Domain\Interfaces\PersonArea\Notice\INoticeRepository;

class NoticeService{

    public function __construct(private INoticeRepository $repository){}

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
