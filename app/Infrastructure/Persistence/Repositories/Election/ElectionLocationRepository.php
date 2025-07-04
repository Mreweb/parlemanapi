<?php

namespace App\Infrastructure\Persistence\Repositories\Election;
use App\Application\Services\CacheService;
use App\Domain\Interfaces\IElectionLocationRepository;
use App\Infrastructure\Persistence\Eloquent\Election\ElectionLocationEloquent;
use Illuminate\Support\Facades\DB;

class ElectionLocationRepository implements IElectionLocationRepository {

    public function list(array $filters){
        $query = ElectionLocationEloquent::query();
        $query->select(
            'election_location_id',
            'election_location.election_location_province_id',
            'election_location.election_location_title',
            'province.province_name',
            'election_location.created_at',
            'election_location.updated_at'
        );
        $query->leftJoin('province', 'province.province_id', '=', 'election_location.election_location_province_id');

        if (!empty($filters['province_id'])) {
            $query->where('election_location_province_id',  $filters['province_id']);
        }
        if (!empty($filters['election_location_title'])) {
            $query->where('election_location_title', 'like', '%' . $filters['election_location_title'] . '%');
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
        $query = ElectionLocationEloquent::query();
        $query->select(
            'election_location_id',
            'election_location.election_location_province_id',
            'election_location.election_location_title',
            'province.province_name',
            'election_location.created_at',
            'election_location.updated_at'
        );
        $query->leftJoin('province', 'province.province_id', '=', 'election_location.election_location_province_id');
        $data['list'] = $query->get();
        if(CacheService::has_data('all_elections')){
            $data = CacheService::get_data('all_elections');
            $data['from_cache'] = true;
            return $data;
        }
        CacheService::set_data('all_elections',$data);
        return $data;
    }
    public function findById(int $id){
        $query = ElectionLocationEloquent::query();
        $query->select(
            'election_location_id',
            'election_location.election_location_province_id',
            'election_location.election_location_title',
            'province.province_name',
            'election_location.created_at',
            'election_location.updated_at'
        );
        $query->leftJoin('province', 'province.province_id', '=', 'election_location.election_location_province_id');
        $query->where('election_location_id', $id);
        $result = $query->get()->toArray();


        $cities = DB::table('election_location_city')
            ->select('city_id','city_name')
            ->leftJoin('city', 'city.city_id', '=', 'election_location_city.election_location_city_id')
            ->where('election_location_city.election_location_id', $id)->get()->toArray();
        $result[0]['citites'] = $cities;
        return $result;
    }
    public function create(array $data){
        $cities = $data['election_location_cities'];
        $data =  ElectionLocationEloquent::create([
            'election_location_title' => $data['election_location_title'],
            'election_location_province_id' => $data['election_location_province_id']
        ]);
        $record = $data->toArray();
        foreach ($cities as $item) {
            DB::table('election_location_city')->insert([
                'election_location_id' => $record['election_location_id'],
                'election_location_city_id' => $item
            ]);
        }
        CacheService::forget_data('all_elections');
        return $data;

    }
    public function update(array $data){
        $result = ElectionLocationEloquent::where('election_location_id',$data['election_location_id'])->update([
            'election_location_title'=>$data['election_location_title'],
            'election_location_province_id'=>$data['election_location_province_id']
        ]);
        $cities = $data['election_location_cities'];
        DB::table('election_location_city')->where('election_location_id',$data['election_location_id'])->delete();
        foreach ($cities as $item) {
            DB::table('election_location_city')->insert([
                'election_location_id' => $data['election_location_id'],
                'election_location_city_id' => $item
            ]);
        }
        CacheService::forget_data('all_elections');
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            CacheService::forget_data('all_elections');
            return ElectionLocationEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
