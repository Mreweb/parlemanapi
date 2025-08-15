<?php

namespace App\Application\Services\Utility\Media;
use App\Domain\Interfaces\Utility\Media\IUploadRepository;

class UploadService{

    public function __construct(private IUploadRepository $repository){}

    public function save(array $data){
        return $this->repository->save($data);
    }
    public function get_file(string $id){
        return $this->repository->get_file($id);
    }
}
