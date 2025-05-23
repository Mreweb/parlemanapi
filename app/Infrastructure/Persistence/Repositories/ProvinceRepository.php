<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Interfaces\IProvinceRepository;
use App\Infrastructure\Persistence\Eloquent\ProvinceEloquent;

class ProvinceRepository implements IProvinceRepository{


    public function list(array $filters, int $perPage){
        $query = ProvinceEloquent::query();
        $query->select('province_id','province_name');
        if (!empty($filters['province_id'])) {
            $query->where('province_id', $filters['province_id']);
        }
        if (!empty($filters['province_name'])) {
            $query->where('province_name', 'like', '%' . $filters['province_name'] . '%');
        }
        return $query->get()->toArray();
    }
    public function findById(int $id){
        $query = ProvinceEloquent::query();
        $query->select('province_id','province_name');
        $query->where('province_id', $id);
        return $query->get()->toArray();
    }
    public function get_cities(int $id){
        return ProvinceEloquent::find($id)->cities->toArray();
    }

    public function create(array $data){
        return ProvinceEloquent::create($data);
    }
    public function update(array $data){
        $result = ProvinceEloquent::where('province_id',$data['province_id'])->update(['province_name'=>$data['province_name']]);
        return $result;
    }
    public function delete(int $id){
        $province = ProvinceEloquent::findOrFail($id)->delete();
        return $province;
    }
}
