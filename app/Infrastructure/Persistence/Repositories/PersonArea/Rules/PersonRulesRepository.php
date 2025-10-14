<?php

namespace App\Infrastructure\Persistence\Repositories\PersonArea\Rules;

use App\Domain\Interfaces\PersonArea\Rules\IRulesRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Rules\PersonRulesEloquent;
use App\Infrastructure\Persistence\Repositories\Utility\Media\File\UploadRepository;
use Illuminate\Support\Facades\DB;

class PersonRulesRepository implements IRulesRepository
{
    public function all(array $filters)
    {
        $query = PersonRulesEloquent::query();
        $query->select('person_rules.*');
        $data['count'] = $query->count();
        $data['list'] = $query->get();
        return $data;
    }

    public function list(array $filters)
    {
        $query = PersonRulesEloquent::query();
        $query->select('person_rules.*');
        $data['count'] = $query->count();
        if (!empty($filters['page_index'])) {
            $query->skip(--$filters['page_index'] * $filters['page_size']);
        }
        if (!empty($filters['page_size'])) {
            $query->take($filters['page_size']);
        }
        $data['list'] = $query->get();
        return $data;
    }

    public function findById(int $id)
    {
        $query = PersonRulesEloquent::query();
        $query->select('person_rules.*');
        $query->where('rule_id', $id);
        $result = $query->get()->toArray();
        if(!isset($result[0])){
            return [];
        }
        $result[0]['attachments'] = (new UploadRepository())->get_attachments($result[0]['rule_id'], (new PersonRulesEloquent()->getTable()));
        return $result;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $attachments = $data['attachments'];
            unset($data['attachments']);
            $result = PersonRulesEloquent::create($data);

            (new UploadRepository())->add_attachments($attachments, (new PersonRulesEloquent()->getTable()), $result->rule_id);
            return $result;
        });
    }

    public function update(array $data){

        return DB::transaction(function () use ($data) {
            $attachments = $data['attachments'];
            unset($data['attachments']);
            $result = PersonRulesEloquent::where('rule_id', $data['rule_id'])->update($data);
            (new UploadRepository())->add_attachments($attachments, (new PersonRulesEloquent()->getTable()), $data['rule_id']);
            return $result;
        });
    }

    public function delete(int $id)
    {
        $city = $this->findById($id);
        if ($city) {
            return PersonRulesEloquent::findOrFail($id)->delete();
        } else {
            return false;
        }
    }
}
