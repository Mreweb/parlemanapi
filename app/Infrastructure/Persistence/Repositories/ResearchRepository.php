<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IResearchRepository;
use App\Infrastructure\Persistence\Eloquent\PersonResearchEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonResearchSignaturesEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonResearchTeamEloquent;

class ResearchRepository implements IResearchRepository {

    public function list(array $filters){
        $query = PersonResearchEloquent::query();
        $query->select('person_research.*');
        $query->leftJoin('president', 'president.president_id', '=', 'person_research.person_research_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_research.person_research_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_research.person_research_parliament_period_id');

        if (!empty($filters['person_research_president_id'])) {
            $query->where('person_research_president_id', 'like', '%' . $filters['person_research_president_id'] . '%');
        }
        if (!empty($filters['person_research_gov_period_id'])) {
            $query->where('person_research_gov_period_id', 'like', '%' . $filters['person_research_gov_period_id'] . '%');
        }
        if (!empty($filters['person_research_parliament_period_id'])) {
            $query->where('person_research_parliament_period_id', 'like', '%' . $filters['person_research_parliament_period_id'] . '%');
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
        $query = PersonResearchEloquent::query();
        $query->select('person_research.*');
        $query->leftJoin('president', 'president.president_id', '=', 'person_research.person_research_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_research.person_research_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_research.person_research_parliament_period_id');
         $query->where('person_research_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        $person_research_team_person_id = $data['person_research_team_person_ids'];
        $person_research_signatures_person_ids = $data['person_research_signatures_person_ids'];
        unset($data['person_research_team_person_ids']);
        unset($data['person_research_signatures_person_ids']);

        $result =  PersonResearchEloquent::create($data);
        foreach ($person_research_team_person_id as $signature_person_id) {
            PersonResearchTeamEloquent::create(
                [
                    'person_research_id' => $result->person_research_id ,
                    'person_research_team_person_id' => $signature_person_id
                ]
            );
        }

        foreach ($person_research_signatures_person_ids as $signature_person_id) {
            PersonResearchSignaturesEloquent::create(
                [
                    'person_research_id' => $result->person_research_id ,
                    'person_research_signature_person_id' => $signature_person_id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){

        $person_research_team_person_id = $data['person_research_team_person_ids'];
        $person_research_signatures_person_ids = $data['person_research_signatures_person_ids'];
        unset($data['person_research_team_person_ids']);
        unset($data['person_research_signatures_person_ids']);


        $result = PersonResearchEloquent::where('person_research_id',$data['person_research_id'])->update(
            $data
        );

        PersonResearchTeamEloquent::where('person_research_id',$data['person_research_id'])->delete();
        foreach ($person_research_team_person_id as $signature_person_id) {
            PersonResearchTeamEloquent::create(
                [
                    'person_research_id' => $data['person_research_id'],
                    'person_research_team_person_id' => $signature_person_id
                ]
            );
        }

        PersonResearchSignaturesEloquent::where('person_research_id',$data['person_research_id'])->delete();
        foreach ($person_research_signatures_person_ids as $signature_person_id) {
            PersonResearchSignaturesEloquent::create(
                [
                    'person_research_id' => $data['person_research_id'],
                    'person_research_signature_person_id' => $signature_person_id
                ]
            );
        }

        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return PersonResearchEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
