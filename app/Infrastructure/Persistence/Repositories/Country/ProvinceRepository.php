<?php

namespace App\Infrastructure\Persistence\Repositories\Country;
use App\Application\Services\CacheService;
use App\Domain\Interfaces\IProvinceRepository;
use App\Infrastructure\Persistence\Eloquent\Country\ProvinceEloquent;

class ProvinceRepository implements IProvinceRepository{


    public function list(array $filters){
        $query = ProvinceEloquent::query();
        $query->select('province_id','province_name','created_at','updated_at');
        if (!empty($filters['province_id'])) {
            $query->where('province_id', $filters['province_id']);
        }
        if (!empty($filters['province_name'])) {
            $query->where('province_name', 'like', '%' . $filters['province_name'] . '%');
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
    public function all(){
        if(CacheService::has_data('all_province')){
            $data = CacheService::get_data('all_province');
            $data['from_cache'] = true;
            return $data;
        }
        $query = ProvinceEloquent::query();
        $query->select('province_id','province_name','created_at','updated_at');
        $data['list'] = $query->get();
        CacheService::set_data('all_province',$data);
        return $data;
    }
    public function findById(int $id){
        $query = ProvinceEloquent::query();
        $query->select('province_id','province_name','created_at','updated_at');
        $query->where('province_id', $id);
        return $query->get()->toArray();
    }
    public function get_cities(int $id){
        return ProvinceEloquent::find($id)->cities->toArray();
    }
    public function create(array $data){
        CacheService::forget_data('all_province');
        return ProvinceEloquent::create($data);
    }
    public function update(array $data){
        CacheService::forget_data('all_province');
        $result = ProvinceEloquent::where('province_id',$data['province_id'])->update(['province_name'=>$data['province_name']]);
        return $result;
    }
    public function delete(int $id){
        $province = $this->findById($id);
        if($province){
            CacheService::forget_data('all_province');
            return ProvinceEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }

    }

}
