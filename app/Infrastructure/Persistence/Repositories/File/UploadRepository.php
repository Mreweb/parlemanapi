<?php

namespace App\Infrastructure\Persistence\Repositories\File;
use App\Domain\Interfaces\IUploadRepository;
use App\Infrastructure\Persistence\Eloquent\File\UploadEloquent;

class UploadRepository implements IUploadRepository {


    public function save(array $data){
        return UploadEloquent::create($data);
    }

    public function get_file(string $id){
        if($id!=null && $id != ""){
            $query = UploadEloquent::query();
            $query->select('*');
            $query->where('media_id', $id);
            $query->orWhere('row_id', $id);
            return $query->get()->toArray();
        }
        return "";
    }
}
