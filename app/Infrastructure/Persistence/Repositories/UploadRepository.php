<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IUploadRepository;
use App\Infrastructure\Persistence\Eloquent\UploadEloquent;

class UploadRepository implements IUploadRepository {


    public function save(array $data){
        return UploadEloquent::create($data);
    }

    public function get_file(string $id){

        $query = UploadEloquent::query();
        $query->select('*');
        $query->where('media_id', $id);
        return $query->get()->toArray();


    }
}
