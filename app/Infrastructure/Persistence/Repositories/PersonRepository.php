<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Application\Services\DBMessageService;
use App\Domain\Interfaces\IPersonRepository;
use App\Infrastructure\Persistence\Eloquent\PersonEloquent;

class PersonRepository implements IPersonRepository {

    public function list(array $filters, int $perPage){
        $query = PersonEloquent::query();
        $query->select('person_id','person_name','person_last_name',
            'person_national_code','person_phone','person_email',
            'person_gender','person_province_id','username',
            'created_at','updated_at'
        );
        if (!empty($filters['person_national_code'])) {
            $query->where('person_national_code', $filters['person_national_code']);
        }
        if (!empty($filters['person_phone'])) {
            $query->where('person_phone', $filters['person_phone']);
        }
        if (!empty($filters['person_last_name'])) {
            $query->where('person_last_name', 'like', '%' . $filters['person_last_name'] . '%');
        }
        return $query->get()->toArray();
    }
    public function findById(int $id){
        $query = PersonEloquent::query();
        $query->select('person_id','person_name','person_last_name','person_national_code','person_phone','person_email','person_gender','person_province_id','username');
        $query->where('person_id', $id);
        return $query->get()->toArray();
    }
    public function findByField($field, $value){
        $query = PersonEloquent::query();
        $query->select('person_id','person_name','person_last_name','person_national_code','person_phone','person_email','person_gender','person_province_id','username');
        $query->where($field, $value);
        return $query->get()->toArray();
    }
    public function create(array $data){

        $person = $this->findByField('person_phone', $data['person_phone']);
        if($person){
            return [];
        } else{
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            return PersonEloquent::create($data)['person_id'];
        }
    }
    public function update(array $data){
        $result = PersonEloquent::where('person_id',$data['person_id'])->update(
            [
                'person_name'=>$data['person_name'],
                'person_last_name'=>$data['person_last_name'],
                'person_national_code'=>$data['person_national_code'],
                'person_phone'=>$data['person_phone'],
                'person_email'=>$data['person_email'],
                'person_gender'=>$data['person_gender'],
                'person_province_id'=>$data['person_province_id'],
                'username'=>$data['username'],
                'password'=>$data['password']
            ]
        );
        return $result;
    }
    public function delete(int $id){
        $province = PersonEloquent::findOrFail($id)->delete();
        return $province;
    }
}
