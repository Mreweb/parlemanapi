<?php

namespace App\Infrastructure\Persistence\Repositories\Person;
use App\Domain\Interfaces\IPersonRepository;
use App\Infrastructure\Persistence\Eloquent\Commission\PersonCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\Election\PersonElectionEloquent;
use App\Infrastructure\Persistence\Eloquent\Fraction\PersonFractionEloquent;
use App\Infrastructure\Persistence\Eloquent\Person\PersonEloquent;
use Illuminate\Support\Facades\Crypt;

class PersonRepository implements IPersonRepository {

    public function list(array $filters){
        $query = PersonEloquent::query();
        $query->select('person_id','person_name','person_last_name',
            'person_national_code','person_phone','person_email',
            'person_gender','person_province_id','username','password',
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
        $query = PersonEloquent::query();
        $query->select('person_id','person_name','person_last_name','person_role','person_national_code','person_phone','person_email','person_gender','person_province_id','username','password');
        $query->where('person_id', $id);
        $data =  $query->get()->toArray()[0];
        return $data;
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
            $data['password'] = md5($data['password']);
            return PersonEloquent::create($data)['person_id'];
        }
    }
    public function update(array $data){

        if(isset($data['password']) &&  $data['password'] != '') {
            $data['password'] = md5($data['password']);
            $result = PersonEloquent::where('person_id', $data['person_id'])->update(
                [
                    'person_name' => $data['person_name'],
                    'person_last_name' => $data['person_last_name'],
                    'person_national_code' => $data['person_national_code'],
                    'person_phone' => $data['person_phone'],
                    'person_gender' => $data['person_gender'],
                    'person_province_id' => $data['person_province_id'],
                    'username' => $data['username'],
                    'password' => $data['password']
                ]
            );
        } else{
            $result = PersonEloquent::where('person_id', $data['person_id'])->update(
                [
                    'person_name' => $data['person_name'],
                    'person_last_name' => $data['person_last_name'],
                    'person_national_code' => $data['person_national_code'],
                    'person_phone' => $data['person_phone'],
                    'person_gender' => $data['person_gender'],
                    'person_province_id' => $data['person_province_id'],
                    'username' => $data['username']
                ]
            );
        }
        return $result;
    }
    public function delete(int $id){
        $province = PersonEloquent::findOrFail($id)->delete();
        return $province;
    }

    public function update_fraction(array $data){
        PersonFractionEloquent::where('person_id', $data['person_id'])->delete();
        return PersonFractionEloquent::create($data)['person_id'];
    }
    public function update_election(array $data){
        PersonElectionEloquent::where('person_id', $data['person_id'])->delete();
        return PersonElectionEloquent::create($data)['person_id'];
    }
    public function update_commission(array $data){
        PersonCommissionEloquent::where('person_id', $data['person_id'])->delete();
        return PersonCommissionEloquent::create($data)['person_id'];
    }
}
