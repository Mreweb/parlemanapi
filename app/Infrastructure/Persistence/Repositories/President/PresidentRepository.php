<?php

namespace App\Infrastructure\Persistence\Repositories\President;
use App\Application\Services\CacheService;
use App\Domain\Interfaces\IPresidentRepository;
use App\Infrastructure\Persistence\Eloquent\President\PresidentEloquent;

class PresidentRepository implements IPresidentRepository{

    public function list(array $filters){
        $query = PresidentEloquent::query();
        $query->select(
            'president_id','president_name',
            'created_at',
            'updated_at');
        if (!empty($filters['president_name'])) {
            $query->where('president_name', 'like', '%' . $filters['president_name'] . '%');
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
        if(CacheService::has_data('all_presidents')){
            $data = CacheService::get_data('all_presidents');
            $data['from_cache'] = true;
            return $data;
        }
        $query = PresidentEloquent::query();
        $query->select(
            'president_id','president_name',
            'created_at',
            'updated_at');
        $data['list'] = $query->get();
        CacheService::set_data('all_presidents',$data);
        return $data;
    }
    public function findById(int $id){
        $query = PresidentEloquent::query();
        $query->select('president_id','president_name','created_at','updated_at');
        $query->where('president_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        CacheService::forget_data('all_presidents');
        return PresidentEloquent::create($data);
    }
    public function update(array $data){
        CacheService::forget_data('all_presidents');
        $result = PresidentEloquent::where('president_id',$data['president_id'])->update(['president_name'=>$data['president_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            CacheService::forget_data('all_presidents');
            return PresidentEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
