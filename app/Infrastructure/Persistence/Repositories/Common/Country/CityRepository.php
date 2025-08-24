<?php

namespace App\Infrastructure\Persistence\Repositories\Common\Country;
use App\Domain\Interfaces\Common\Country\ICityRepository;
use App\Infrastructure\Persistence\Eloquent\Common\Country\CityEloquent;

class CityRepository implements ICityRepository {
    public function list(array $filters){
        $query = CityEloquent::query();
        $query->select('city_id','city_name','province.province_id','province.province_name','city.created_at','city.updated_at');
        $query->leftJoin('province', 'province.province_id', '=', 'city.city_province_id');
        if (!empty($filters['province_id'])) {
            $query->where('province_id',  $filters['province_id']);
        }
        if (!empty($filters['city_name'])) {
            $query->where('city_name', '=', '%' . $filters['city_name'] . '%');
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
//        $query = CityEloquent::query();
//        $query->select('city_id','city_name','province.province_id','province.province_name');
//        $query->leftJoin('province', 'province.province_id', '=', 'city.city_province_id');
//        $query->where('city_id', $id);
//        $result = $query->get()->toArray();
//        $query = CityEloquent::findOrFail($id)->with('province')->toArray();
//        return $result;

        return CityEloquent::with('province')->where('city_id',$id)->get()->toArray();

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
