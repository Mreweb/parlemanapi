<?php

namespace App\Application\Services;
use App\Domain\Interfaces\IProvinceRepository;

class ProvinceService{

    public function __construct(private IProvinceRepository $repository){}

    public function list(array $filters, int $perPage){
        return $this->repository->list($filters, $perPage);
    }

    public function get(int $id)
    {
        return $this->repository->findById($id);
    }
    public function get_cities(int $id)
    {
        return $this->repository->get_cities($id);
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
