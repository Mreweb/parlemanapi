<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IElectionLocationRepository;
use App\Infrastructure\Persistence\Eloquent\ElectionLocationEloquent;
use Illuminate\Support\Facades\DB;

class ElectionLocationRepository implements IElectionLocationRepository {

    public function list(array $filters, int $perPage){
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
        if (!empty($filters['election_location_title'])) {
            $query->where('election_location_title', 'like', '%' . $filters['election_location_title'] . '%');
        }
        return $query->get()->toArray();
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
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return ElectionLocationEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
