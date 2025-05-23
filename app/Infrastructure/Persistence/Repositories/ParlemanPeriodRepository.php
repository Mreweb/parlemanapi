<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Interfaces\IParlemanPeriod;
use App\Infrastructure\Persistence\Eloquent\ParlemanPeriodEloquent;

class ParlemanPeriodRepository implements IParlemanPeriod{

    public function list(array $filters, int $perPage){
        $query = ParlemanPeriodEloquent::query();
        $query->select('period_title');
        if (!empty($filters['period_title'])) {
            $query->where('period_title', 'like', '%' . $filters['period_title'] . '%');
        }
        return $query->get()->toArray();
    }
    public function findById(int $id){
        $query = ParlemanPeriodEloquent::query();
        $query->select('period_id','period_title','created_at','updated_at');
        $query->where('period_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return ParlemanPeriodEloquent::create($data);
    }
    public function update(array $data){
        $result = ParlemanPeriodEloquent::where('period_id',$data['period_id'])->update(['period_title'=>$data['period_title']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return ParlemanPeriodEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
