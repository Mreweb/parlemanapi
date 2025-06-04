<?php

namespace App\Application\Services;
use App\Infrastructure\Persistence\Repositories\AuthRepository;
use App\Infrastructure\Persistence\Repositories\UploadRepository;

class UploadService{

    public function __construct(private UploadRepository $repository){}

    public function save(array $data){
        return $this->repository->save($data);
    }
    public function get_file(string $id){
        return $this->repository->get_file($id);
    }
}
