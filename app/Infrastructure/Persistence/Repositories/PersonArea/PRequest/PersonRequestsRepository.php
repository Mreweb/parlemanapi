<?php

namespace App\Infrastructure\Persistence\Repositories\PersonArea\PRequest;

use App\Domain\Interfaces\PersonArea\Requests\IRequestsRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\PRequests\PersonRequestEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\PRequests\PersonRequestTrackEloquent;
use App\Infrastructure\Persistence\Repositories\Utility\Media\File\UploadRepository;
use Illuminate\Support\Facades\DB;

class PersonRequestsRepository implements IRequestsRepository
{

    public function list(array $filters)
    {
        $query = PersonRequestEloquent::query();
        $query->select(
            'request_id',
            'request_title',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_requests.created_at',
            'person_requests.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_requests.request_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_requests.request_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_requests.request_parliament_period_id');
        if (!empty($filters['request_title'])) {
            $query->where('request_title', 'like', '%' . $filters['request_title'] . '%');
        }
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
        $query = PersonRequestEloquent::query();
        $query->select('*');
        $query->where('request_id', $id);
        $result = $query->get()->toArray();
        if(!isset($result[0])){
            return [];
        }
        $result[0]['tracks'] = $this->getTracById($id);
        $result[0]['attachments'] = (new UploadRepository())->get_attachments($result[0]['request_id'], (new PersonRequestEloquent()->getTable()));
        return $result;
    }

    public function create(array $data){
        return DB::transaction(function () use ($data) {
            $attachments = $data['attachments'];
            unset($data['attachments']);
            $result = PersonRequestEloquent::create($data);
            (new UploadRepository())->add_attachments($attachments, (new PersonRequestEloquent()->getTable()), $result->request_id);
            return $result;
        });


    }

    public function update(array $data){
        $attachments = $data['attachments'];
        unset($data['attachments']);
        $result = PersonRequestEloquent::where('request_id', $data['request_id'])->update($data);
        (new UploadRepository())->add_attachments($attachments, (new PersonRequestEloquent()->getTable()), $data['request_id']);

        return $result;
    }

    public function delete(int $id)
    {
        $city = $this->findById($id);
        if ($city) {
            return PersonRequestEloquent::findOrFail($id)->delete();
        } else {
            return false;
        }
    }


    public function findTrackById(int $id)
    {
        $query = PersonRequestTrackEloquent::query();
        $query->select('*');
        $query->where('row_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }

    public function add_track(array $data)
    {
        return PersonRequestTrackEloquent::create($data);
    }

    public function update_track(array $data)
    {
        $result = PersonRequestTrackEloquent::where('row_id', $data['row_id'])->update($data);
        return $result;
    }

    public function delete_track(int $id)
    {
        $city = $this->findTrackById($id);
        if ($city) {
            return PersonRequestTrackEloquent::findOrFail($id)->delete();
        } else {
            return false;
        }
    }

    public function getTracById(int $id)
    {
        return PersonRequestTrackEloquent::where('request_id', $id)->get()->toArray();
    }


}
