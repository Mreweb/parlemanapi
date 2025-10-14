<?php

namespace App\Infrastructure\Persistence\Repositories\PersonArea\Person;

use App\Domain\Interfaces\PersonArea\Person\IPersonRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Person\PersonEloquent;

class PersonRepository implements IPersonRepository{

    public function all(array $filters){
        $query = PersonEloquent::query()->select([
                'person_id', 'person_name', 'person_last_name',
                'person_national_code', 'person_phone', 'person_email',
                'person_gender', 'person_province_id', 'username', 'person_image',
                'created_at', 'updated_at'
            ])
            ->when(!empty($filters['person_national_code']), fn($q) => $q->where('person_national_code', $filters['person_national_code']))
            ->when(!empty($filters['person_phone']), fn($q) => $q->where('person_phone', $filters['person_phone']))
            ->when(!empty($filters['person_province_id']), fn($q) => $q->where('person_province_id', $filters['person_province_id']))
            ->when(!empty($filters['person_last_name']), fn($q) => $q->where('person_last_name', 'like', "%{$filters['person_last_name']}%"))
            ->orderByDesc('person_id');

        $data['count'] = $query->count();

        if (!empty($filters['page_index']) && !empty($filters['page_size'])) {
            $query->skip(($filters['page_index'] - 1) * $filters['page_size'])
                ->take($filters['page_size']);
        }

        $data['list'] = $query->get()->toArray();

        return $data;
    }

    public function list(array $filters){
        if (!empty($filters['page_index']) && !empty($filters['page_size'])) {
        $query = PersonEloquent::query()->select([
                'person_id', 'person_name', 'person_last_name',
                'person_national_code', 'person_phone', 'person_email',
                'person_gender', 'person_province_id', 'username', 'person_image',
                'created_at', 'updated_at'
            ])
            ->when(!empty($filters['person_national_code']), fn($q) => $q->where('person_national_code', $filters['person_national_code']))
            ->when(!empty($filters['person_phone']), fn($q) => $q->where('person_phone', $filters['person_phone']))
            ->when(!empty($filters['person_province_id']), fn($q) => $q->where('person_province_id', $filters['person_province_id']))
            ->when(!empty($filters['person_last_name']), fn($q) => $q->where('person_last_name', 'like', "%{$filters['person_last_name']}%"))
            ->orderByDesc('person_id');
        } else{
            $query = PersonEloquent::query()->select([
                'person_id', 'person_name', 'person_last_name'
            ])
                ->when(!empty($filters['person_national_code']), fn($q) => $q->where('person_national_code', $filters['person_national_code']))
                ->when(!empty($filters['person_phone']), fn($q) => $q->where('person_phone', $filters['person_phone']))
                ->when(!empty($filters['person_province_id']), fn($q) => $q->where('person_province_id', $filters['person_province_id']))
                ->when(!empty($filters['person_last_name']), fn($q) => $q->where('person_last_name', 'like', "%{$filters['person_last_name']}%"))
                ->orderByDesc('person_id');
        }

        $data['count'] = $query->count();

        if (!empty($filters['page_index']) && !empty($filters['page_size'])) {
            $query->skip(($filters['page_index'] - 1) * $filters['page_size'])
                ->take($filters['page_size']);
        }

        $data['list'] = $query->get()->toArray();

        return $data;
    }

    public function findById(int $id)
    {
        return PersonEloquent::select([
            'person_id', 'person_name', 'person_last_name', 'person_image',
            'person_role', 'person_national_code', 'person_phone', 'person_email',
            'person_gender', 'person_province_id', 'username'
        ])
            ->findOrFail($id)
            ->toArray();
    }

    public function findByField($field, $value)
    {
        return PersonEloquent::where($field, $value)
            ->get([
                'person_id', 'person_name', 'person_last_name', 'person_national_code',
                'person_phone', 'person_email', 'person_gender', 'person_province_id', 'username'
            ])
            ->toArray();
    }

    public function create(array $data)
    {
        $defaults = [
            'password' => md5('12345'),
            'person_image' => '-',
            'person_last_name' => 'ln',
            'person_name' => 'fn',
            'person_national_code' => '1234567890',
            'person_phone' => '12345',
            'person_role' => 'parliament_person',
            'username' => 'username',
        ];

        $data = array_merge($defaults, $data);

        $person = PersonEloquent::create($data);

        return $person->person_id ?? null;
    }

    public function update(array $data)
    {
        $person = PersonEloquent::findOrFail($data['person_id']);

        if (!empty($data['password'])) {
            $data['password'] = md5($data['password']);
        } else {
            unset($data['password']);
        }

        $person->update($data);

        return $person->wasChanged();
    }

    public function delete(int $id)
    {
        return PersonEloquent::destroy($id);
    }

    public function update_fraction(array $data)
    {
        return $this->syncRelation($data, 'fractions');
    }

    public function update_election(array $data)
    {
        return $this->syncRelation($data, 'elections');
    }

    public function update_commission(array $data){
        return $this->syncRelation($data, 'commissions');
    }

    protected function syncRelation(array $data, string $relation){
        $person = PersonEloquent::findOrFail($data['person_id']);
        $person->$relation()->delete();
        return $person->$relation()->create($data);
    }

    public function get_all_info(int $id){
        $person = PersonEloquent::with([
            'commissions.commission',
            'elections.electionLocation',
            'fractions.fraction',
            'interpellations',
            'meetings',
            'notices',
            'projects',
            'questions',
            'requests',
            'researches',
            'rules',
            'ruleFortyFive',
            'ruleTtf',
            'trips',
            'voteConfidences'
        ])->findOrFail($id);

        return $person->toArray();
    }
}
