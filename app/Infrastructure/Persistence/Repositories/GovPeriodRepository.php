<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Interfaces\IGovPeriodRepository;
use App\Infrastructure\Persistence\Eloquent\GovPeriodEloquent;

class GovPeriodRepository implements IGovPeriodRepository{

    public function list(array $filters, int $perPage){
        $query = GovPeriodEloquent::query();
        $query->select('gov_period_id','gov_period_name','created_at','updated_at');
        if (!empty($filters['gov_period_name'])) {
            $query->where('gov_period_name', 'like', '%' . $filters['gov_period_name'] . '%');
        }
        return $query->get()->toArray();
    }
    public function findById(int $id){
        $query = GovPeriodEloquent::query();
        $query->select('gov_period_id','gov_period_name','created_at','updated_at');
        $query->where('gov_period_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return GovPeriodEloquent::create($data);
    }
    public function update(array $data){
        $result = GovPeriodEloquent::where('gov_period_id',$data['gov_period_id'])->update(['gov_period_name'=>$data['gov_period_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return GovPeriodEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
