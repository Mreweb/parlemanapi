<?php

namespace App\Infrastructure\Persistence\Repositories\Commission;
use App\Application\Services\CacheService;
use App\Domain\Interfaces\ICommissionRepository;
use App\Infrastructure\Persistence\Eloquent\Commission\CommissionEloquent;

class CommissionRepository implements ICommissionRepository {

    public function list(array $filters){
        $query = CommissionEloquent::query();
        $query->select('commission_id','commission_name','created_at','updated_at');
        if (!empty($filters['commission_name'])) {
            $query->where('commission_name', 'like', '%' . $filters['commission_name'] . '%');
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
        if(CacheService::has_data('all_commissions')){
            $data = CacheService::get_data('all_commissions');
            $data['from_cache'] = true;
            return $data;
        }
        $query = CommissionEloquent::query();
        $query->select('commission_id','commission_name','created_at','updated_at');
        $data['list'] = $query->get();
        CacheService::set_data('all_commissions',$data);
        return $data;
    }
    public function findById(int $id){
        $query = CommissionEloquent::query();
        $query->select('commission_id','commission_name','created_at','updated_at');
        $query->where('commission_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        CacheService::forget_data('all_commissions');
        return CommissionEloquent::create($data);
    }
    public function update(array $data){
        CacheService::forget_data('all_commissions');
        $result = CommissionEloquent::where('commission_id',$data['commission_id'])->update(['commission_name'=>$data['commission_name']]);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            CacheService::forget_data('all_commissions');
            return CommissionEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
