<?php

namespace App\Infrastructure\Persistence\Repositories\PersonArea\Meeting;
use App\Domain\Interfaces\PersonArea\Meeting\IMeetingRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Meeting\PersonMeetingEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Meeting\PersonMeetingTrackEloquent;
use App\Infrastructure\Persistence\Repositories\Utility\Media\File\UploadRepository;
use Illuminate\Support\Facades\DB;

class MeetingRepository implements IMeetingRepository {

    public function list(array $filters){
        $query = PersonMeetingEloquent::query();
        $query->select(
            'meeting_id',
            'meeting_title',
            'meeting_description',
            'meeting_status',
            'meeting_end_date',
            'meeting_tasks',
            'president_name',
            'gov_period_name',
            'person_meeting.created_at',
            'person_meeting.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_meeting.meeting_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_meeting.meeting_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_meeting.meeting_parliament_period_id');
        if (!empty($filters['meeting_title'])) {
            $query->where('meeting_title', 'like', '%' . $filters['meeting_title'] . '%');
        }
        if (!empty($filters['meeting_president_id'])) {
            $query->where('meeting_president_id', 'like', '%' . $filters['meeting_president_id'] . '%');
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
        $query = PersonMeetingEloquent::query();
        $query->select(
            'person_meeting.*',
            'meeting_id',
            'meeting_title',
            'meeting_description',
            'meeting_status',
            'meeting_end_date',
            'meeting_tasks',
            'president_name',
            'gov_period_name',
            'person_meeting.created_at',
            'person_meeting.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_meeting.meeting_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_meeting.meeting_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_meeting.meeting_parliament_period_id');
        $query->where('meeting_id', $id);
        $result = $query->get()->toArray();
        $result[0]['track'] = $this->get_meeting_track($result[0]['meeting_id']);
        $result[0]['attachments'] = (new UploadRepository())->get_attachments($result[0]['meeting_id'], (new PersonMeetingEloquent()->getTable()));
        return $result;
    }
    public function create(array $data){

        return DB::transaction(function () use ($data) {
            $attachments = $data['attachments'];
            unset($data['attachments']);
            $result =  PersonMeetingEloquent::create($data);
            (new UploadRepository())->add_attachments($attachments, (new PersonMeetingEloquent()->getTable()), $result->meeting_id);
            return $result;
        });

    }
    public function update(array $data){

        return DB::transaction(function () use ($data) {
            $attachments = $data['attachments'];
            unset($data['attachments']);

            $result = PersonMeetingEloquent::where('meeting_id',$data['meeting_id'])->update(
                $data
            );
            (new UploadRepository())->add_attachments($attachments, (new PersonMeetingEloquent()->getTable()), $data['meeting_id']);
            return $result;
        });


    }
    public function add_meeting_track(array $data){
        $result = PersonMeetingTrackEloquent::create($data);
        return $result;
    }
    public function update_meeting_track(array $data){
        $result = PersonMeetingTrackEloquent::where('row_id',$data['row_id'])->update(
            $data
        );
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return PersonMeetingEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function get_meeting_track(int $id)
    {
        return  PersonMeetingTrackEloquent::query()->where('meeting_track_meeting_id', $id)->get()->toArray();
    }
}
