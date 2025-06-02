<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IMinistryRepository;
use App\Infrastructure\Persistence\Eloquent\MinistryEloquent;
use App\Infrastructure\Persistence\Eloquent\PresidentEloquent;

class MinistryRepository implements IMinistryRepository {

    public function list(array $filters, int $perPage){
        $query = MinistryEloquent::query();
        $query->select(
            'ministry_id','ministry_name',
            'created_at',
            'updated_at');
        if (!empty($filters['ministry_name'])) {
            $query->where('ministry_name', 'like', '%' . $filters['ministry_name'] . '%');
        }
        return $query->get()->toArray();
    }
    public function findById(int $id){
        $query = MinistryEloquent::query();
        $query->select('ministry_id','ministry_name','created_at','updated_at');
        $query->where('ministry_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return MinistryEloquent::create($data);
    }
    public function update(array $data){
        $result = MinistryEloquent::where('ministry_id',$data['ministry_id'])->update(['ministry_name'=>$data['ministry_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return MinistryEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
