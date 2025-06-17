<?php

namespace App\Infrastructure\Persistence\Repositories\PRequest;
use App\Domain\Interfaces\IRequestsRepository;
use App\Infrastructure\Persistence\Eloquent\PRequests\PersonRequestEloquent;
use App\Infrastructure\Persistence\Eloquent\PRequests\PersonRequestTrackEloquent;

class PersonRequestsRepository implements IRequestsRepository {

    public function list(array $filters){
        $query = PersonRequestEloquent::query();
        $query->select(
            'request_id',
            'request_title',
            'created_at',
            'updated_at');
        if (!empty($filters['request_title'])) {
            $query->where('request_title', 'like', '%' . $filters['request_title'] . '%');
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
        $query = PersonRequestEloquent::query();
        $query->select('*');
        $query->where('request_id', $id);
        $result = $query->get()->toArray();
        $result[0]['tracks'] = $this->getTracById($id);
        return $result;
    }
    public function create(array $data){
        return PersonRequestEloquent::create($data);
    }
    public function update(array $data){
        $result = PersonRequestEloquent::where('request_id',$data['request_id'])->update($data);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return PersonRequestEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }


    public function findTrackById(int $id){
        $query = PersonRequestTrackEloquent::query();
        $query->select('*');
        $query->where('row_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function add_track(array $data){
        return PersonRequestTrackEloquent::create($data);
    }
    public function update_track(array $data){
        $result = PersonRequestTrackEloquent::where('row_id',$data['row_id'])->update($data);
        return $result;
    }
    public function delete_track(int $id){
        $city = $this->findTrackById($id);
        if($city){
            return PersonRequestTrackEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
    public function getTracById(int $id)
    {
        return PersonRequestTrackEloquent::where('request_id',$id)->get()->toArray();
    }


}
