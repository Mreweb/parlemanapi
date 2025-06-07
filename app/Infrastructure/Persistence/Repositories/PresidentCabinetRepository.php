<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IPresidentCabinetRepository;
use App\Infrastructure\Persistence\Eloquent\PresidentCabinetEloquent;

class PresidentCabinetRepository implements IPresidentCabinetRepository{

    public function list(array $filters){
        $query = PresidentCabinetEloquent::query();
        $query->select(
            'president.president_id',
            'cabinet',
            'cabinet_person_id',
            'president_cabinet.created_at',
            'president_cabinet.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'president_cabinet.president_id');
        $query->leftJoin('person', 'person.person_id', '=', 'president_cabinet.cabinet_person_id');
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
        $query = PresidentCabinetEloquent::query();
        $query->select(
            'president_cabinet.president_id',
            'cabinet',
            'cabinet_person_id',
            'president_cabinet.created_at',
            'president_cabinet.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'president_cabinet.president_id');
        $query->leftJoin('person', 'person.person_id', '=', 'president_cabinet.cabinet_person_id');
        $query->where('president_cabinet.row_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        return PresidentCabinetEloquent::create($data);
    }
    public function update(array $data){
        $result = PresidentCabinetEloquent::where('row_id',$data['row_id'])->update(
            [
                'president_id'=>$data['president_id'],
                'cabinet'=>$data['cabinet'],
                'cabinet_person_id'=>$data['cabinet_person_id']
            ]
        );
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return PresidentCabinetEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
