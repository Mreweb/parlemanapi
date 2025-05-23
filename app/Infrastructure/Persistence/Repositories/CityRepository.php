<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Interfaces\ICityRepository;
use App\Infrastructure\Persistence\Eloquent\CityEloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CityRepository implements ICityRepository {

    public function list(array $filters, int $perPage){
        $query = CityEloquent::query();
        $query->select('city_id','city_name','province.province_id','province.province_name');
        $query->leftJoin('province', 'province.province_id', '=', 'city.city_province_id');
        if (!empty($filters['city_id'])) {
            $query->where('city_id', $filters['city_id']);
        }
        if (!empty($filters['city_name'])) {
            $query->where('city_name', 'like', '%' . $filters['city_name'] . '%');
        }
        return $query->get()->toArray();
    }
    public function findById(int $id){
        $query = CityEloquent::query();
        $query->select('city_id','city_name','province.province_id','province.province_name');
        $query->leftJoin('province', 'province.province_id', '=', 'city.city_province_id');
        $query->where('city_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return CityEloquent::create($data);
    }
    public function update(array $data){
        $result = CityEloquent::where('city_id',$data['city_id'])->update(['city_name'=>$data['city_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return CityEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
