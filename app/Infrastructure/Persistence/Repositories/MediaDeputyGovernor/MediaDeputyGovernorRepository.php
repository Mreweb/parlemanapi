<?php

namespace App\Infrastructure\Persistence\Repositories\MediaDeputyGovernor;
use App\Domain\Interfaces\IMediaDeputyGovernorRepository;
use App\Infrastructure\Persistence\Eloquent\MediaDeputyGovernor\MediaDeputyGovernorActionsEloquent;
use App\Infrastructure\Persistence\Eloquent\MediaDeputyGovernor\MediaDeputyGovernorApprovalsEloquent;
use App\Infrastructure\Persistence\Eloquent\MediaDeputyGovernor\MediaDeputyGovernorBoardEloquent;
use App\Infrastructure\Persistence\Eloquent\MediaDeputyGovernor\MediaDeputyGovernorEloquent;

class MediaDeputyGovernorRepository implements IMediaDeputyGovernorRepository {

    public function list(array $filters){
        $query = MediaDeputyGovernorEloquent::query();
        $query->select(
            'media_id',
            'media_subject',
            'media_description',
            'media_province_id',
            'media_end_date',
            'media_start_date',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_deputy_governor_trip.created_at',
            'person_deputy_governor_trip.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_deputy_governor_media.media_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_deputy_governor_media.media_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_deputy_governor_media.media_parliament_period_id');
        if (!empty($filters['media_subject'])) {
            $query->where('media_subject', 'like', '%' . $filters['media_subject'] . '%');
        }
        if (!empty($filters['media_president_id'])) {
            $query->where('media_president_id', '=',  $filters['media_president_id']);
        }
        if (!empty($filters['media_gov_period_id'])) {
            $query->where('media_gov_period_id', 'like', '%' . $filters['media_gov_period_id'] . '%');
        }
        if (!empty($filters['media_parliament_period_id'])) {
            $query->where('media_parliament_period_id', 'like', '%' . $filters['media_parliament_period_id'] . '%');
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
        $query = MediaDeputyGovernorEloquent::query();
        $query->select(
            'person_deputy_governor_media.*',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_deputy_governor_media.created_at',
            'person_deputy_governor_media.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_deputy_governor_media.media_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_deputy_governor_media.media_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_deputy_governor_media.media_parliament_period_id');
        $query->where('media_id', $id);
        $result = $query->get()->toArray();
        if(!empty($result)){
            $result[0]['actions'] = $this->findActionsById($result[0]['media_id']);
            $result[0]['approvals'] = $this->findApprovalsById($result[0]['media_id']);
            $result[0]['boards'] = $this->findBoardById($result[0]['media_id']);
        }
        return $result;
    }
    public function create(array $data){
        $person_media_board_person_ids  = $data['person_media_board_person_ids'];
        unset($data['person_media_board_person_ids']);
        $result =  MediaDeputyGovernorEloquent::create($data);
        foreach ($person_media_board_person_ids as $id) {
            MediaDeputyGovernorBoardEloquent::create(
                [
                    'media_id' => $result->media_id,
                    'board_person_id' => $id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){
        $person_media_board_person_ids  = $data['person_media_board_person_ids'];
        unset($data['person_media_board_person_ids']);

        $result = MediaDeputyGovernorEloquent::where('media_id',$data['media_id'])->update(
            $data
        );

        MediaDeputyGovernorBoardEloquent::where('media_id',$data['media_id'])->delete();
        foreach ($person_media_board_person_ids as $id) {
            MediaDeputyGovernorBoardEloquent::create(
                [
                    'media_id' =>$data['media_id'],
                    'board_person_id' => $id
                ]
            );
        }


        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return MediaDeputyGovernorEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function findActionsById(int $id)
    {        return MediaDeputyGovernorActionsEloquent::query()->select('*')->where('media_id',$id)->get()->toArray();

    }
    public function findApprovalsById(int $id)
    {
        return MediaDeputyGovernorApprovalsEloquent::query()->select('*')->where('media_id',$id)->get()->toArray();

    }
    public function findBoardById(int $id)
    {
        return MediaDeputyGovernorBoardEloquent::query()->select('board_person_id as person_id')->where('media_id',$id)->get()->toArray();

    }

    public function add_approval(array $data)
    {
        $result = MediaDeputyGovernorApprovalsEloquent::create(
            [
                'media_id' => $data['media_id'],
                'approval_description' => $data['approval_description']
            ]
        );
        return $result;
    }
    public function update_approval(array $data)
    {
        $result = MediaDeputyGovernorApprovalsEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }

    public function add_action(array $data)
    {
        $result = MediaDeputyGovernorActionsEloquent::create(
            [
                'media_id' => $data['media_id'],
                'action_description' => $data['action_description']
            ]
        );
        return $result;
    }
    public function update_action(array $data)
    {
        $result = MediaDeputyGovernorActionsEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }

}
