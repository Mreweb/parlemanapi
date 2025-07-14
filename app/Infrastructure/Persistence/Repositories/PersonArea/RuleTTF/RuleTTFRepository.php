<?php

namespace App\Infrastructure\Persistence\Repositories\RuleTTF;
use App\Domain\Interfaces\IRuleTTFRepository;
use App\Infrastructure\Persistence\Eloquent\RuleTTF\RuleTTFEloquent;
use App\Infrastructure\Persistence\Eloquent\RuleTTF\RuleTTFSignaturesEloquent;
use App\Infrastructure\Persistence\Repositories\File\UploadRepository;

class RuleTTFRepository implements IRuleTTFRepository {

    public function list(array $filters){
        $query = RuleTTFEloquent::query();
        $query->select('person_rule_ttf.*',
            'period_title',
            'president_name',
            'gov_period_name');
        $query->leftJoin('president', 'president.president_id', '=', 'person_rule_ttf.rule_ttf_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_rule_ttf.rule_ttf_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_rule_ttf.rule_ttf_parliament_period_id');

        if (!empty($filters['rule_ttf_president_id'])) {
            $query->where('rule_ttf_president_id', 'like', '%' . $filters['rule_ttf_president_id'] . '%');
        }
        if (!empty($filters['rule_ttf_gov_period_id'])) {
            $query->where('rule_ttf_gov_period_id', 'like', '%' . $filters['rule_ttf_gov_period_id'] . '%');
        }
        if (!empty($filters['rule_ttf_parliament_period_id'])) {
            $query->where('rule_ttf_parliament_period_id', 'like', '%' . $filters['rule_ttf_parliament_period_id'] . '%');
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
        $query = RuleTTFEloquent::query();
        $query->select('person_rule_ttf.*');
        $query->leftJoin('president', 'president.president_id', '=', 'person_rule_ttf.rule_ttf_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_rule_ttf.rule_ttf_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_rule_ttf.rule_ttf_parliament_period_id');
        $query->where('rule_ttf_id', $id);
        $result = $query->get()->toArray();

        $result[0]['worksheet'] =$this->findWorkSheetById($result[0]['rule_ttf_id']);
        $result[0]['persons'] =$this->findSignaturesById($result[0]['rule_ttf_id']);

        return $result;
    }
    public function create(array $data){
        $rule_ttf_signatures_person_ids = $data['rule_ttf_signatures_person_ids'];
        unset($data['rule_ttf_signatures_person_ids']);

        $result =  RuleTTFEloquent::create($data);
        foreach ($rule_ttf_signatures_person_ids as $signature_person_id) {
            RuleTTFSignaturesEloquent::create(
                [
                    'rule_ttf_id' => $result->rule_ttf_id ,
                    'rule_ttf_supporters_person_id' => $signature_person_id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){

        $rule_ttf_signatures_person_ids = $data['rule_ttf_signatures_person_ids'];
        unset($data['rule_ttf_signatures_person_ids']);

        $result = RuleTTFEloquent::where('rule_ttf_id',$data['rule_ttf_id'])->update(
            $data
        );

        RuleTTFSignaturesEloquent::where('rule_ttf_id',$data['rule_ttf_id'])->delete();
        foreach ($rule_ttf_signatures_person_ids as $signature_person_id) {
            RuleTTFSignaturesEloquent::create(
                [
                    'rule_ttf_id' => $data['rule_ttf_id'],
                    'rule_ttf_supporters_person_id' => $signature_person_id
                ]
            );
        }

        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return RuleTTFEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function findWorkSheetById(int $id){
        return (new UploadRepository())->get_file($id);
    }
    public function findSignaturesById(int $id){
        return RuleTTFSignaturesEloquent::query()->select('rule_ttf_supporters_person_id as person_id')->where('rule_ttf_id',$id)->get()->toArray();

    }

}
