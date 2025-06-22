<?php

namespace App\Infrastructure\Persistence\Repositories\Research;

use App\Domain\Interfaces\IResearchRepository;
use App\Infrastructure\Persistence\Eloquent\Research\PersonResearchEloquent;
use App\Infrastructure\Persistence\Eloquent\Research\PersonResearchSignaturesEloquent;
use App\Infrastructure\Persistence\Eloquent\Research\PersonResearchTeamEloquent;
use App\Infrastructure\Persistence\Repositories\File\UploadRepository;

class ResearchRepository implements IResearchRepository {

    public function list(array $filters){
        $query = PersonResearchEloquent::query();
        $query->select('person_research.*',
            'period_title',
            'president_name',
            'gov_period_name');
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
        $result[0]['signatures_persons'] = $this->findSignaturesById($result[0]['person_research_id']);
        $result[0]['team_persons'] = $this->findTeamById($result[0]['person_research_id']);
        $result[0]['worksheet'] = $this->findWorkSheetById($result[0]['person_research_worksheet_media_id']);
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
    public function findSignaturesById(int $id)
    {        return PersonResearchSignaturesEloquent::query()->select('person_research_signature_person_id as person_id')->where('person_research_id',$id)->get()->toArray();

    }
    public function findTeamById(int $id)
    {
        return PersonResearchTeamEloquent::query()->select('person_research_team_person_id as person_id')->where('person_research_id',$id)->get()->toArray();

    }
    public function findWorkSheetById(int $id){
        return (new UploadRepository())->get_file($id);
    }
}
