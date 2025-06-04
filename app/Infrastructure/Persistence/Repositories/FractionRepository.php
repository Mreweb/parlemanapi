<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IFractionRepository;
use App\Infrastructure\Persistence\Eloquent\FractionEloquent;

class FractionRepository implements IFractionRepository {

    public function list(array $filters){
        $query = FractionEloquent::query();
        $query->select('fraction_id','fraction_name','created_at','updated_at');
        if (!empty($filters['fraction_name'])) {
            $query->where('fraction_name', 'like', '%' . $filters['fraction_name'] . '%');
        }
        $data['count'] = $query->count();
        if (!empty($filters['page_index'])) {
            $query->skip(--$filters['page_index']*$filters['page_size']);
        }
        if (!empty($filters['page_size'])) {
            $query->take($filters['page_size']);
        }
        $data['list'] = $query->get();
        return $data;

    }
    public function findById(int $id){
        $query = FractionEloquent::query();
        $query->select('fraction_id','fraction_name','created_at','updated_at');
        $query->where('fraction_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return FractionEloquent::create($data);
    }
    public function update(array $data){
        $result = FractionEloquent::where('fraction_id',$data['fraction_id'])->update(['fraction_name'=>$data['fraction_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return FractionEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
