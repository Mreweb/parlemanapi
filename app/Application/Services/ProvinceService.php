<?php

namespace App\Application\Services;


use App\Infrastructure\Persistence\Repositories\Country\ProvinceRepository;

class ProvinceService{

    public function __construct(private ProvinceRepository $repository){}

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
