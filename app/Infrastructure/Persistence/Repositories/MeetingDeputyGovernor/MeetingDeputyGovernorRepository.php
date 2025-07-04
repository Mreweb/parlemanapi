<?php

namespace App\Infrastructure\Persistence\Repositories\MeetingDeputyGovernor;
use App\Domain\Interfaces\IMeetingDeputyGovernorRepository;
use App\Infrastructure\Persistence\Eloquent\MeetingDeputyGovernor\MeetingDeputyGovernorActionsEloquent;
use App\Infrastructure\Persistence\Eloquent\MeetingDeputyGovernor\MeetingDeputyGovernorApprovalsEloquent;
use App\Infrastructure\Persistence\Eloquent\MeetingDeputyGovernor\MeetingDeputyGovernorBoardEloquent;
use App\Infrastructure\Persistence\Eloquent\MeetingDeputyGovernor\MeetingDeputyGovernorEloquent;

class MeetingDeputyGovernorRepository implements IMeetingDeputyGovernorRepository {

    public function list(array $filters){
        $query = MeetingDeputyGovernorEloquent::query();
        $query->select(
            'meeting_id',
            'meeting_subject',
            'meeting_description',
            'meeting_province_id',
            'meeting_end_date',
            'meeting_start_date',
            'meeting_end_date',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_deputy_governor_meeting.created_at',
            'person_deputy_governor_meeting.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_deputy_governor_meeting.meeting_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_deputy_governor_meeting.meeting_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_deputy_governor_meeting.meeting_parliament_period_id');
        if (!empty($filters['meeting_subject'])) {
            $query->where('meeting_subject', 'like', '%' . $filters['meeting_subject'] . '%');
        }
        if (!empty($filters['meeting_president_id'])) {
            $query->where('meeting_president_id', '=',  $filters['meeting_president_id']);
        }
        if (!empty($filters['meeting_gov_period_id'])) {
            $query->where('meeting_gov_period_id', 'like', '%' . $filters['meeting_gov_period_id'] . '%');
        }
        if (!empty($filters['meeting_parliament_period_id'])) {
            $query->where('meeting_parliament_period_id', 'like', '%' . $filters['meeting_parliament_period_id'] . '%');
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
        $query = MeetingDeputyGovernorEloquent::query();
        $query->select(
            'person_deputy_governor_meeting.*',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_deputy_governor_meeting.created_at',
            'person_deputy_governor_meeting.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_deputy_governor_meeting.meeting_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_deputy_governor_meeting.meeting_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_deputy_governor_meeting.meeting_parliament_period_id');
        $query->where('meeting_id', $id);
        $result = $query->get()->toArray();
        if(!empty($result)){
            $result[0]['actions'] = $this->findActionsById($result[0]['meeting_id']);
            $result[0]['approvals'] = $this->findApprovalsById($result[0]['meeting_id']);
            $result[0]['boards'] = $this->findBoardById($result[0]['meeting_id']);
        }
        return $result;
    }
    public function create(array $data){
        $person_meeting_board_person_ids  = $data['person_meeting_board_person_ids'];
        unset($data['person_meeting_board_person_ids']);
        $result =  MeetingDeputyGovernorEloquent::create($data);
        foreach ($person_meeting_board_person_ids as $id) {
            MeetingDeputyGovernorBoardEloquent::create(
                [
                    'meeting_id' => $result->meeting_id,
                    'board_person_id' => $id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){
        $person_meeting_board_person_ids  = $data['person_meeting_board_person_ids'];
        unset($data['person_meeting_board_person_ids']);

        $result = MeetingDeputyGovernorEloquent::where('meeting_id',$data['meeting_id'])->update(
            $data
        );

        MeetingDeputyGovernorBoardEloquent::where('meeting_id',$data['meeting_id'])->delete();
        foreach ($person_meeting_board_person_ids as $id) {
            MeetingDeputyGovernorBoardEloquent::create(
                [
                    'meeting_id' =>$data['meeting_id'],
                    'board_person_id' => $id
                ]
            );
        }


        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return MeetingDeputyGovernorEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function findActionsById(int $id)
    {        return MeetingDeputyGovernorActionsEloquent::query()->select('*')->where('meeting_id',$id)->get()->toArray();

    }
    public function findApprovalsById(int $id)
    {
        return MeetingDeputyGovernorApprovalsEloquent::query()->select('*')->where('meeting_id',$id)->get()->toArray();

    }
    public function findBoardById(int $id)
    {
        return MeetingDeputyGovernorBoardEloquent::query()->select('board_person_id as person_id')->where('meeting_id',$id)->get()->toArray();

    }

    public function add_approval(array $data)
    {
        $result = MeetingDeputyGovernorApprovalsEloquent::create(
            [
                'meeting_id' => $data['meeting_id'],
                'approval_description' => $data['approval_description']
            ]
        );
        return $result;
    }
    public function update_approval(array $data)
    {
        $result = MeetingDeputyGovernorApprovalsEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }

    public function add_action(array $data)
    {
        $result = MeetingDeputyGovernorActionsEloquent::create(
            [
                'meeting_id' => $data['meeting_id'],
                'action_description' => $data['action_description']
            ]
        );
        return $result;
    }
    public function update_action(array $data)
    {
        $result = MeetingDeputyGovernorActionsEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }

}
