<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\ICommissionRepository;
use App\Infrastructure\Persistence\Eloquent\CommissionEloquent;

class CommissionRepository implements ICommissionRepository {

    public function list(array $filters, int $perPage){
        $query = CommissionEloquent::query();
        $query->select('commission_id','commission_name','created_at','updated_at');
        if (!empty($filters['commission_name'])) {
            $query->where('commission_name', 'like', '%' . $filters['commission_name'] . '%');
        }
        return $query->get()->toArray();
    }
    public function findById(int $id){
        $query = CommissionEloquent::query();
        $query->select('commission_id','commission_name');
        $query->where('commission_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return CommissionEloquent::create($data);
    }
    public function update(array $data){
        $result = CommissionEloquent::where('commission_id',$data['commission_id'])->update(['commission_name'=>$data['commission_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return CommissionEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
