<?php

namespace App\Infrastructure\Persistence\Repositories\Trip;
use App\Domain\Interfaces\ITripRepository;
use App\Infrastructure\Persistence\Eloquent\Trip\TripActionsEloquent;
use App\Infrastructure\Persistence\Eloquent\Trip\TripApprovalsEloquent;
use App\Infrastructure\Persistence\Eloquent\Trip\TripBoardEloquent;
use App\Infrastructure\Persistence\Eloquent\Trip\TripEloquent;
use Illuminate\Support\Facades\DB;

class TripRepository implements ITripRepository {

    public function list(array $filters){
        $query = TripEloquent::query();
        $query->select(
            'trip_id',
            'trip_subject',
            'trip_description',
            'trip_province_id',
            'trip_end_date',
            'trip_start_date',
            'trip_end_date',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_trip.created_at',
            'person_trip.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_trip.trip_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_trip.trip_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_trip.trip_parliament_period_id');
        if (!empty($filters['trip_subject'])) {
            $query->where('trip_subject', 'like', '%' . $filters['trip_subject'] . '%');
        }
        if (!empty($filters['trip_president_id'])) {
            $query->where('trip_president_id', '=',  $filters['trip_president_id']);
        }
        if (!empty($filters['trip_gov_period_id'])) {
            $query->where('trip_gov_period_id', 'like', '%' . $filters['trip_gov_period_id'] . '%');
        }
        if (!empty($filters['trip_parliament_period_id'])) {
            $query->where('trip_parliament_period_id', 'like', '%' . $filters['trip_parliament_period_id'] . '%');
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
        $query = TripEloquent::query();
        $query->select(
            'trip_id',
            'trip_subject',
            'trip_description',
            'trip_province_id',
            'trip_end_date',
            'trip_start_date',
            'trip_end_date',
            'period_title',
            'president_name',
            'gov_period_name',
            'person_trip.created_at',
            'person_trip.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_trip.trip_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_trip.trip_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_trip.trip_parliament_period_id');
        $query->where('trip_id', $id);
        $result = $query->get()->toArray();
        $result[0]['actions'] = $this->findActionsById($result[0]['trip_id']);
        $result[0]['approvals'] = $this->findApprovalsById($result[0]['trip_id']);
        $result[0]['boards'] = $this->findBoardById($result[0]['trip_id']);
        return $result;
    }
    public function create(array $data){
        $person_trip_board_person_ids  = $data['person_trip_board_person_ids'];
        unset($data['person_trip_board_person_ids']);
        $result =  TripEloquent::create($data);
        foreach ($person_trip_board_person_ids as $id) {
            TripBoardEloquent::create(
                [
                    'trip_id' => $result->trip_id,
                    'board_person_id' => $id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){
        $person_trip_board_person_ids  = $data['person_trip_board_person_ids'];
        unset($data['person_trip_board_person_ids']);

        $result = TripEloquent::where('trip_id',$data['trip_id'])->update(
            $data
        );

        TripBoardEloquent::where('trip_id',$data['trip_id'])->delete();
        foreach ($person_trip_board_person_ids as $id) {
            TripBoardEloquent::create(
                [
                    'trip_id' =>$data['trip_id'],
                    'board_person_id' => $id
                ]
            );
        }


        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return TripBoardEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function findActionsById(int $id)
    {        return TripActionsEloquent::query()->select('*')->where('trip_id',$id)->get()->toArray();

    }
    public function findApprovalsById(int $id)
    {
        return TripApprovalsEloquent::query()->select('*')->where('trip_id',$id)->get()->toArray();

    }
    public function findBoardById(int $id)
    {
        return TripBoardEloquent::query()->select('board_person_id as person_id')->where('trip_id',$id)->get()->toArray();

    }

    public function add_approval(array $data)
    {
        $result = TripApprovalsEloquent::create(
            [
                'trip_id' => $data['trip_id'],
                'approval_description' => $data['approval_description']
            ]
        );
        return $result;
    }
    public function update_approval(array $data)
    {
        $result = TripApprovalsEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }

    public function add_action(array $data)
    {
        $result = TripActionsEloquent::create(
            [
                'trip_id' => $data['trip_id'],
                'action_description' => $data['action_description']
            ]
        );
        return $result;
    }
    public function update_action(array $data)
    {
        $result = TripActionsEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }
}
