<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Domain\Interfaces\IRuleFortyFiveRepository;
use App\Infrastructure\Persistence\Eloquent\RuleFortyFiveEloquent;
use App\Infrastructure\Persistence\Eloquent\RuleFortyFiveSignaturesEloquent;

class RuleFortyFiveRepository implements IRuleFortyFiveRepository {

    public function list(array $filters){
        $query = RuleFortyFiveEloquent::query();
        $query->select('rule_forty_five.*');
        $query->leftJoin('president', 'president.president_id', '=', 'rule_forty_five.rule_forty_five_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'rule_forty_five.rule_forty_five_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'rule_forty_five.rule_forty_five_parliament_period_id');

        if (!empty($filters['rule_forty_five_president_id'])) {
            $query->where('rule_forty_five_president_id', 'like', '%' . $filters['rule_forty_five_president_id'] . '%');
        }
        if (!empty($filters['rule_forty_five_gov_period_id'])) {
            $query->where('rule_forty_five_gov_period_id', 'like', '%' . $filters['rule_forty_five_gov_period_id'] . '%');
        }
        if (!empty($filters['rule_forty_five_parliament_period_id'])) {
            $query->where('rule_forty_five_parliament_period_id', 'like', '%' . $filters['rule_forty_five_parliament_period_id'] . '%');
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
        $query = RuleFortyFiveEloquent::query();
        $query->select('rule_forty_five.*');
        $query->leftJoin('president', 'president.president_id', '=', 'rule_forty_five.rule_forty_five_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'rule_forty_five.rule_forty_five_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'rule_forty_five.rule_forty_five_parliament_period_id');
         $query->where('rule_forty_five_id', $id);
        $result = $query->get()->toArray();
        return $result;
    }
    public function create(array $data){
        $rule_forty_five_signatures_person_ids = $data['rule_forty_five_signatures_person_ids'];
        unset($data['rule_forty_five_signatures_person_ids']);

        $result =  RuleFortyFiveEloquent::create($data);
        foreach ($rule_forty_five_signatures_person_ids as $signature_person_id) {
            RuleFortyFiveSignaturesEloquent::create(
                [
                    'rule_forty_five_id' => $result->rule_forty_five_id ,
                    'rule_forty_five_supporters_person_id' => $signature_person_id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){

        $rule_forty_five_signatures_person_ids = $data['rule_forty_five_signatures_person_ids'];
        unset($data['rule_forty_five_signatures_person_ids']);

        $result = RuleFortyFiveEloquent::where('rule_forty_five_id',$data['rule_forty_five_id'])->update(
            $data
        );

        RuleFortyFiveSignaturesEloquent::where('rule_forty_five_id',$data['rule_forty_five_id'])->delete();
        foreach ($rule_forty_five_signatures_person_ids as $signature_person_id) {
            RuleFortyFiveSignaturesEloquent::create(
                [
                    'rule_forty_five_id' => $data['rule_forty_five_id'] ,
                    'rule_forty_five_supporters_person_id' => $signature_person_id
                ]
            );
        }

        return $result;
    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return RuleFortyFiveEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }
}
