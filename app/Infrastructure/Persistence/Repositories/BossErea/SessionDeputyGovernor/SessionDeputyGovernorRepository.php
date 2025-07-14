<?php

namespace App\Infrastructure\Persistence\Repositories\SessionDeputyGovernor;
use App\Domain\Interfaces\ISessionDeputyGovernorRepository;
use App\Infrastructure\Persistence\Eloquent\SessionDeputyGovernor\SessionDeputyGovernorActionsEloquent;
use App\Infrastructure\Persistence\Eloquent\SessionDeputyGovernor\SessionDeputyGovernorApprovalsEloquent;
use App\Infrastructure\Persistence\Eloquent\SessionDeputyGovernor\SessionDeputyGovernorBoardEloquent;
use App\Infrastructure\Persistence\Eloquent\SessionDeputyGovernor\SessionDeputyGovernorEloquent;

class SessionDeputyGovernorRepository implements ISessionDeputyGovernorRepository {

    public function list(array $filters){
        $query = SessionDeputyGovernorEloquent::query();
        $query->select(
            'session_id',
            'session_subject',
            'session_description',
            'session_province_id',
            'session_end_date',
            'session_start_date',
            'session_end_date',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_deputy_governor_session.created_at',
            'person_deputy_governor_session.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_deputy_governor_session.session_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_deputy_governor_session.session_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_deputy_governor_session.session_parliament_period_id');
        if (!empty($filters['session_subject'])) {
            $query->where('session_subject', 'like', '%' . $filters['session_subject'] . '%');
        }
        if (!empty($filters['session_president_id'])) {
            $query->where('session_president_id', '=',  $filters['session_president_id']);
        }
        if (!empty($filters['session_gov_period_id'])) {
            $query->where('session_gov_period_id', 'like', '%' . $filters['session_gov_period_id'] . '%');
        }
        if (!empty($filters['session_parliament_period_id'])) {
            $query->where('session_parliament_period_id', 'like', '%' . $filters['session_parliament_period_id'] . '%');
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
        $query = SessionDeputyGovernorEloquent::query();
        $query->select(
            'person_deputy_governor_session.*',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_deputy_governor_session.created_at',
            'person_deputy_governor_session.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_deputy_governor_session.session_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_deputy_governor_session.session_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_deputy_governor_session.session_parliament_period_id');
        $query->where('session_id', $id);
        $result = $query->get()->toArray();
        if(!empty($result)){
            $result[0]['actions'] = $this->findActionsById($result[0]['session_id']);
            $result[0]['approvals'] = $this->findApprovalsById($result[0]['session_id']);
            $result[0]['boards'] = $this->findBoardById($result[0]['session_id']);
        }
        return $result;
    }
    public function create(array $data){
        $person_session_board_person_ids  = $data['person_session_board_person_ids'];
        unset($data['person_session_board_person_ids']);
        $result =  SessionDeputyGovernorEloquent::create($data);
        foreach ($person_session_board_person_ids as $id) {
            SessionDeputyGovernorBoardEloquent::create(
                [
                    'session_id' => $result->session_id,
                    'board_person_id' => $id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){
        $person_session_board_person_ids  = $data['person_session_board_person_ids'];
        unset($data['person_session_board_person_ids']);

        $result = SessionDeputyGovernorEloquent::where('session_id',$data['session_id'])->update(
            $data
        );

        SessionDeputyGovernorBoardEloquent::where('session_id',$data['session_id'])->delete();
        foreach ($person_session_board_person_ids as $id) {
            SessionDeputyGovernorBoardEloquent::create(
                [
                    'session_id' =>$data['session_id'],
                    'board_person_id' => $id
                ]
            );
        }


        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return SessionDeputyGovernorEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function findActionsById(int $id)
    {        return SessionDeputyGovernorActionsEloquent::query()->select('*')->where('session_id',$id)->get()->toArray();

    }
    public function findApprovalsById(int $id)
    {
        return SessionDeputyGovernorApprovalsEloquent::query()->select('*')->where('session_id',$id)->get()->toArray();

    }
    public function findBoardById(int $id)
    {
        return SessionDeputyGovernorBoardEloquent::query()->select('board_person_id as person_id')->where('session_id',$id)->get()->toArray();

    }

    public function add_approval(array $data)
    {
        $result = SessionDeputyGovernorApprovalsEloquent::create(
            [
                'session_id' => $data['session_id'],
                'approval_description' => $data['approval_description']
            ]
        );
        return $result;
    }
    public function update_approval(array $data)
    {
        $result = SessionDeputyGovernorApprovalsEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }

    public function add_action(array $data)
    {
        $result = SessionDeputyGovernorActionsEloquent::create(
            [
                'session_id' => $data['session_id'],
                'action_description' => $data['action_description']
            ]
        );
        return $result;
    }
    public function update_action(array $data)
    {
        $result = SessionDeputyGovernorActionsEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }

}
