<?php

namespace App\Infrastructure\Persistence\Repositories\PersonArea\Plan;
use App\Domain\Interfaces\PersonArea\plan\IPlanRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanBill85ReviewEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanDeputyActionsEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanGuardianCouncilEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanMainCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanPromoteLawEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanPublicCourtEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanRefinementEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanSignaturesEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanSubCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanSuggestResourcesEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanTypeEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanWorkflowCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Plan\PlanSilenceEloquent;

class PlanRepository implements IPlanRepository {

    public function list(array $filters){
        $query = PlanEloquent::query();

        $query->select(
            'plan_id',
            'plan_title',
            'plan_content',
            'plan_prev_title',
            'plan_date',
            'plan_register_number',
            'president_name',
            'gov_period_name',
            'person_plan.created_at',
            'person_plan.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_plan.plan_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_plan.plan_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_plan.plan_parliament_period_id');
        if (!empty($filters['project_title'])) {
            $query->where('plan_title', 'like', '%' . $filters['plan_title'] . '%');
        }
        if (!empty($filters['plan_president_id'])) {
            $query->where('plan_president_id', 'like', '%' . $filters['plan_president_id'] . '%');
        }
        if (!empty($filters['project_gov_period_id'])) {
            $query->where('plan_gov_period_id', 'like', '%' . $filters['plan_gov_period_id'] . '%');
        }
        if (!empty($filters['plan_parliament_period_id'])) {
            $query->where('plan_parliament_period_id', 'like', '%' . $filters['plan_parliament_period_id'] . '%');
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
        $query = planEloquent::query();
        $query->select(
            'person_plan.*',
            'president_name',
            'gov_period_name',
            'person_plan.created_at',
            'person_plan.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_plan.plan_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_plan.plan_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_plan.plan_parliament_period_id');
         $query->where('plan_id', $id);
        $result = $query->get()->toArray();

        $result[0]['main_commission'] = $this->findMainCommissionById($result[0]['plan_id']);
        $result[0]['sub_commission'] = $this->findSubCommissionById($result[0]['plan_id']);
        $result[0]['signatures'] = $this->findSignaturesById($result[0]['plan_id']);
        $result[0]['suggest_resources'] = $this->findSuggestResourcesById($result[0]['plan_id']);
        $result[0]['plan_type'] = $this->findTypeById($result[0]['plan_id']);
        $result[0]['plan_bill_85_review'] = $this->find85ById($result[0]['plan_id']);
        $result[0]['plan_deputy_actions'] = $this->findDeputyActionsById($result[0]['plan_id']);
        $result[0]['plan_guardian_council'] = $this->findGuardianCouncilById($result[0]['plan_id']);
        $result[0]['plan_promote_law'] = $this->findPromoteLawById($result[0]['plan_id']);
        $result[0]['plan_workflow_commission'] = $this->findWorkflowCommissionById($result[0]['plan_id']);
        $result[0]['plan_workflow_public_court'] = $this->findPublicCourtById($result[0]['plan_id']);
        $result[0]['plan_silence'] = $this->findSilenceById($result[0]['plan_id']);
        $result[0]['plan_refiement'] = $this->findRefinementById($result[0]['plan_id']);

        return $result;
    }
    public function create(array $data){

        $main_commission = $data['main_commission'];
        unset($data['main_commission']);
        $sub_commission = $data['sub_commission'];
        unset($data['sub_commission']);
        $signatures = $data['signatures'];
        unset($data['signatures']);
        $suggest_resources = $data['suggest_resources'];
        unset($data['suggest_resources']);
        $type = $data['type'];
        unset($data['type']);
        $type_bill_85_review = $data['bill_85_review'];
        unset($data['bill_85_review']);
        $type_deputy_actions = $data['deputy_actions'];
        unset($data['deputy_actions']);
        $type_guardian_council = $data['guardian_council'];
        unset($data['guardian_council']);
        $type_promote_law = $data['promote_law'];
        unset($data['promote_law']);
        $type_workflow_commission = $data['workflow_commission'];
        unset($data['workflow_commission']);
        $type_workflow_public_court = $data['workflow_public_court'];
        unset($data['workflow_public_court']);
        $silence = $data['silence'];
        unset($data['silence']);
        $refinement = $data['refinement'];
        unset($data['refinement']);
        $result =  planEloquent::create($data);

        foreach ($main_commission as $item) {
            PlanMainCommissionEloquent::create([
                'plan_id' => $result->plan_id,
                'commission_id' => $item
            ]);
        }
        foreach ($sub_commission as $item) {
            planSubCommissionEloquent::create([
                    'plan_id' => $result->plan_id,
                    'commission_id' => $item
            ]);
        }
        foreach ($signatures as $item) {
            planSignaturesEloquent::create([
                    'plan_id' => $result->plan_id,
                    'plan_person_id' => $item
            ]);
        }
        foreach ($suggest_resources as $item) {
            planSuggestResourcesEloquent::create([
                    'plan_id' => $result->plan_id,
                    'suggester' => $item
            ]);
        }
        foreach ($type as $item) {
            PlanTypeEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($type_bill_85_review as $item) {
            PlanBill85ReviewEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($type_deputy_actions as $item) {
            PlanDeputyActionsEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($type_guardian_council as $item) {
            PlanGuardianCouncilEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($type_promote_law as $item) {
            PlanPromoteLawEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($type_workflow_commission as $item) {
            PlanWorkflowCommissionEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($type_workflow_public_court as $item) {
            PlanPublicCourtEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($silence as $item) {
            PlanSilenceEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($refinement as $item) {
            PlanRefinementEloquent::create([ 'plan_id' => $result->plan_id,  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        return $result;

    }
    public function update(array $data){

        $main_commission = $data['main_commission'];
        unset($data['main_commission']);
        $sub_commission = $data['sub_commission'];
        unset($data['sub_commission']);
        $signatures = $data['signatures'];
        unset($data['signatures']);
        $suggest_resources = $data['suggest_resources'];
        unset($data['suggest_resources']);
        $type = $data['type'];
        unset($data['type']);
        $type_bill_85_review = $data['bill_85_review'];
        unset($data['bill_85_review']);
        $type_deputy_actions = $data['deputy_actions'];
        unset($data['deputy_actions']);
        $type_guardian_council = $data['guardian_council'];
        unset($data['guardian_council']);
        $type_promote_law = $data['promote_law'];
        unset($data['promote_law']);
        $type_workflow_commission = $data['workflow_commission'];
        unset($data['workflow_commission']);
        $type_workflow_public_court = $data['workflow_public_court'];
        unset($data['workflow_public_court']);
        $silence = $data['silence'];
        unset($data['silence']);
        $refinement  = $data['refinement'];
        unset($data['refinement']);

        $result = PlanEloquent::where('plan_id',$data['plan_id'])->update(
            $data
        );


        PlanMainCommissionEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($main_commission as $item) {
            PlanMainCommissionEloquent::create([
                'plan_id' => $data['plan_id'],
                'commission_id' => $item
            ]);
        }
        planSubCommissionEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($sub_commission as $item) {
            planSubCommissionEloquent::create([
                'plan_id' => $data['plan_id'],
                'commission_id' => $item
            ]);
        }
        planSignaturesEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($signatures as $item) {
            planSignaturesEloquent::create([
                'plan_id' => $data['plan_id'],
                'plan_person_id' => $item
            ]);
        }
        planSuggestResourcesEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($suggest_resources as $item) {
            planSuggestResourcesEloquent::create([
                'plan_id' => $data['plan_id'],
                'suggester' => $item
            ]);
        }
        PlanTypeEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($type as $item) {
            PlanTypeEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        PlanBill85ReviewEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($type_bill_85_review as $item) {
            PlanBill85ReviewEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        PlanDeputyActionsEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($type_deputy_actions as $item) {
            PlanDeputyActionsEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        PlanGuardianCouncilEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($type_guardian_council as $item) {
            PlanGuardianCouncilEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        PlanPromoteLawEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($type_promote_law as $item) {
            PlanPromoteLawEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        PlanWorkflowCommissionEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($type_workflow_commission as $item) {
            PlanWorkflowCommissionEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        PlanPublicCourtEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($type_workflow_public_court as $item) {
            PlanPublicCourtEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        PlanSilenceEloquent::where('plan_id',$data['plan_id'])->delete();
        foreach ($silence as $item) {
            PlanSilenceEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        foreach ($refinement as $item) {
            PlanRefinementEloquent::create([ 'plan_id' => $data['plan_id'],  'plan_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }

        return $result;


    }
    public function delete(int $id){
        /*$city = $this->findById($id);
        if($city){
            return ProjectsEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }*/
    }

    public function findMainCommissionById(int $id){
        return PlanMainCommissionEloquent::query()->select('commission_id')->where('plan_id',$id)->get()->toArray();
    }
    public function findSubCommissionById(int $id){
        return PlanSubCommissionEloquent::query()->select('commission_id')->where('plan_id',$id)->get()->toArray();
    }
    public function findSignaturesById(int $id){
        return PlanSignaturesEloquent::query()->select('plan_person_id')->where('plan_id',$id)->get()->toArray();
    }
    public function findSuggestResourcesById(int $id){
        return PlanSuggestResourcesEloquent::query()->select('suggester')->where('plan_id',$id)->get()->toArray();
    }
    public function findTypeById(int $id){
        return PlanTypeEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
    public function find85ById(int $id){
        return PlanBill85ReviewEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
    public function findDeputyActionsById(int $id){
        return PlanDeputyActionsEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
    public function findPromoteLawById(int $id){
        return PlanPromoteLawEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
    public function findGuardianCouncilById(int $id){
        return PlanGuardianCouncilEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
    public function findWorkflowCommissionById(int $id){
        return PlanWorkflowCommissionEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
    public function findPublicCourtById(int $id){
        return PlanPublicCourtEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
    public function findSilenceById(int $id){
        return PlanSilenceEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
    public function findRefinementById(int $id){
        return PlanRefinementEloquent::query()->select('plan_detail')->where('plan_id',$id)->get()->toArray();
    }
}
