<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IMeetingRepository;
use App\Infrastructure\Persistence\Eloquent\PersonMeetingTrackEloquent;

class MeetingTrackRepository implements IMeetingRepository {

    public function list(array $filters){
        $query = PersonMeetingTrackEloquent::query();
        $query->select(
            'meeting_track_meeting_id',
            'meeting_track_description',
            'person_meeting_track.created_at',
            'person_meeting_track.updated_at');
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
        $query = PersonMeetingTrackEloquent::query();
        $query->select(
            'meeting_track_meeting_id',
            'meeting_track_description',
            'person_meeting_track.created_at',
            'person_meeting_track.updated_at');
        $query->where('meeting_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        $result =  PersonMeetingTrackEloquent::create($data);
        return $result;

    }
    public function update(array $data){
        $result = PersonMeetingTrackEloquent::where('row_id',$data['meeting_track_meeting_id'])->update(
            $data
        );
        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return PersonMeetingTrackEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
