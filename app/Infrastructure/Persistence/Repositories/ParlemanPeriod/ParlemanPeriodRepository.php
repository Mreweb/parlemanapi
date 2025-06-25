<?php

namespace App\Infrastructure\Persistence\Repositories\ParlemanPeriod;

use App\Application\Services\CacheService;
use App\Domain\Interfaces\IParlemanPeriodRepository;
use App\Infrastructure\Persistence\Eloquent\Period\ParlemanPeriodEloquent;

class ParlemanPeriodRepository implements IParlemanPeriodRepository{

    public function list(array $filters){
        $query = ParlemanPeriodEloquent::query();
        $query->select('period_id','period_title','created_at','updated_at');
        if (!empty($filters['period_title'])) {
            $query->where('period_title', 'like', '%' . $filters['period_title'] . '%');
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
        $query = ParlemanPeriodEloquent::query();
        $query->select('period_id','period_title','created_at','updated_at');
        $data['list'] = $query->get();
        if(CacheService::has_data('all_parleman_periods')){
            $data = CacheService::get_data('all_parleman_periods');
            $data['from_cache'] = true;
            return $data;
        }
        CacheService::set_data('all_parleman_periods',$data);
        return $data;
    }
    public function findById(int $id){
        $query = ParlemanPeriodEloquent::query();
        $query->select('period_id','period_title','created_at','updated_at');
        $query->where('period_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        CacheService::forget_data('all_parleman_periods');
        return ParlemanPeriodEloquent::create($data);
    }
    public function update(array $data){
        CacheService::forget_data('all_parleman_periods');
        $result = ParlemanPeriodEloquent::where('period_id',$data['period_id'])->update(['period_title'=>$data['period_title']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            CacheService::forget_data('all_parleman_periods');
            return ParlemanPeriodEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
