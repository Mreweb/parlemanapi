<?php

namespace App\Infrastructure\Persistence\Repositories\VoteConfidence;
use App\Domain\Interfaces\IVoteConfidenceRepository;
use App\Infrastructure\Persistence\Eloquent\VoteConfidence\VoteConfidenceEloquent;
use App\Infrastructure\Persistence\Eloquent\VoteConfidence\VoteConfidenceOpposingEloquent;
use App\Infrastructure\Persistence\Eloquent\VoteConfidence\VoteConfidenceSupportersEloquent;

class VoteConfidenceRepository implements IVoteConfidenceRepository {

    public function list(array $filters){
        $query = VoteConfidenceEloquent::query();
        $query->select('person_vote_confidence.*',
            'period_title',
            'president_name',
            'gov_period_name');
        $query->leftJoin('president', 'president.president_id', '=', 'person_vote_confidence.vote_confidence_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_vote_confidence.vote_confidence_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_vote_confidence.vote_confidence_parliament_period_id');

        if (!empty($filters['vote_confidence_president_id'])) {
            $query->where('vote_confidence_president_id', 'like', '%' . $filters['vote_confidence_president_id'] . '%');
        }
        if (!empty($filters['vote_confidence_gov_period_id'])) {
            $query->where('vote_confidence_gov_period_id', 'like', '%' . $filters['vote_confidence_gov_period_id'] . '%');
        }
        if (!empty($filters['vote_confidence_parliament_period_id'])) {
            $query->where('vote_confidence_parliament_period_id', 'like', '%' . $filters['vote_confidence_parliament_period_id'] . '%');
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
        $query = VoteConfidenceEloquent::query();
        $query->select('person_vote_confidence.*');
        $query->leftJoin('president', 'president.president_id', '=', 'person_vote_confidence.vote_confidence_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_vote_confidence.vote_confidence_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_vote_confidence.vote_confidence_parliament_period_id');
        $query->where('vote_confidence_id', $id);
        $result = $query->get()->toArray();

        $result[0]['opposing_persons'] = $this->findOpposingById($result[0]['vote_confidence_id']);
        $result[0]['supporters_persons'] = $this->findSupportersById($result[0]['vote_confidence_id']);

        return $result;
    }
    public function create(array $data){
        $vote_confidence_opposing_person_ids = $data['vote_confidence_opposing_person_ids'];
        $vote_confidence_supporters_person_ids = $data['vote_confidence_supporters_person_ids'];
        unset($data['vote_confidence_opposing_person_ids']);
        unset($data['vote_confidence_supporters_person_ids']);

        $result =  VoteConfidenceEloquent::create($data);
        foreach ($vote_confidence_opposing_person_ids as $signature_person_id) {
            VoteConfidenceOpposingEloquent::create(
                [
                    'vote_confidence_id' => $result->vote_confidence_id ,
                    'vote_confidence_opposing_person_id' => $signature_person_id
                ]
            );
        }

        foreach ($vote_confidence_supporters_person_ids as $signature_person_id) {
            VoteConfidenceSupportersEloquent::create(
                [
                    'vote_confidence_id' => $result->vote_confidence_id ,
                    'vote_confidence_supporters_person_id' => $signature_person_id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){

        $vote_confidence_opposing_person_ids = $data['vote_confidence_opposing_person_ids'];
        $vote_confidence_supporters_person_ids = $data['vote_confidence_supporters_person_ids'];
        unset($data['vote_confidence_opposing_person_ids']);
        unset($data['vote_confidence_supporters_person_ids']);

        $result = VoteConfidenceEloquent::where('vote_confidence_id',$data['vote_confidence_id'])->update(
            $data
        );


        VoteConfidenceOpposingEloquent::where('vote_confidence_id',$data['vote_confidence_id'])->delete();
        foreach ($vote_confidence_opposing_person_ids as $signature_person_id) {
            VoteConfidenceOpposingEloquent::create(
                [
                    'vote_confidence_id' => $data['vote_confidence_id'] ,
                    'vote_confidence_opposing_person_id' => $signature_person_id
                ]
            );
        }

        VoteConfidenceSupportersEloquent::where('vote_confidence_id',$data['vote_confidence_id'])->delete();
        foreach ($vote_confidence_supporters_person_ids as $signature_person_id) {
            VoteConfidenceSupportersEloquent::create(
                [
                    'vote_confidence_id' => $data['vote_confidence_id'] ,
                    'vote_confidence_supporters_person_id' => $signature_person_id
                ]
            );
        }

        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return VoteConfidenceEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function findOpposingById(int $id)
    {
        return VoteConfidenceOpposingEloquent::query()->select('vote_confidence_opposing_person_id as person_id')->where('vote_confidence_id',$id)->get()->toArray();
    }

    public function findSupportersById(int $id)
    {
        return VoteConfidenceSupportersEloquent::query()->select('vote_confidence_supporters_person_id as person_id')->where('vote_confidence_id',$id)->get()->toArray();
    }
}
