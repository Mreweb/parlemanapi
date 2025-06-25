<?php

namespace App\Infrastructure\Persistence\Repositories\Ministry;
use App\Application\Services\CacheService;
use App\Domain\Interfaces\IMinistryRepository;
use App\Infrastructure\Persistence\Eloquent\Ministry\MinistryEloquent;

class MinistryRepository implements IMinistryRepository {
    public function list(array $filters){
        $query = MinistryEloquent::query();
        $query->select(
            'ministry_id','ministry_name',
            'created_at',
            'updated_at');
        if (!empty($filters['ministry_name'])) {
            $query->where('ministry_name', 'like', '%' . $filters['ministry_name'] . '%');
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
        $query = MinistryEloquent::query();
        $query->select(
            'ministry_id','ministry_name',
            'created_at',
            'updated_at');
        $data['list'] = $query->get();
        if(CacheService::has_data('all_ministry')){
            $data = CacheService::get_data('all_ministry');
            $data['from_cache'] = true;
            return $data;
        }
        CacheService::set_data('all_ministry',$data);
        return $data;
    }
    public function findById(int $id){
        $query = MinistryEloquent::query();
        $query->select('ministry_id','ministry_name','created_at','updated_at');
        $query->where('ministry_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        CacheService::forget_data('all_ministry');
        return MinistryEloquent::create($data);
    }
    public function update(array $data){
        CacheService::forget_data('all_ministry');
        $result = MinistryEloquent::where('ministry_id',$data['ministry_id'])->update(['ministry_name'=>$data['ministry_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            CacheService::forget_data('all_ministry');
            return MinistryEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
