<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IPresidentRepository;
use App\Infrastructure\Persistence\Eloquent\PresidentEloquent;

class PresidentRepository implements IPresidentRepository{

    public function list(array $filters, int $perPage){
        $query = PresidentEloquent::query();
        $query->select(
            'president_id','president_name',
            'created_at',
            'updated_at');
        if (!empty($filters['president_name'])) {
            $query->where('president_name', 'like', '%' . $filters['president_name'] . '%');
        }
        return $query->get()->toArray();
    }
    public function findById(int $id){
        $query = PresidentEloquent::query();
        $query->select('president_id','president_name');
        $query->where('president_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return PresidentEloquent::create($data);
    }
    public function update(array $data){
        $result = PresidentEloquent::where('president_id',$data['president_id'])->update(['president_name'=>$data['president_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return PresidentEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
