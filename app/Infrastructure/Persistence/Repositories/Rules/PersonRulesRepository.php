<?php

namespace App\Infrastructure\Persistence\Repositories\Rules;
use App\Domain\Interfaces\IRulesRepository;
use App\Infrastructure\Persistence\Eloquent\Rules\PersonRulesEloquent;

class PersonRulesRepository implements IRulesRepository{

    public function list(array $filters){
        $query = PersonRulesEloquent::query();
        $query->select('person_rules.*');
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
        $query = PersonRulesEloquent::query();
        $query->select('person_rules.*');
        $query->where('rule_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return PersonRulesEloquent::create($data);
    }
    public function update(array $data){
        $result = PersonRulesEloquent::where('rule_id',$data['rule_id'])->update($data);
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return PersonRulesEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
