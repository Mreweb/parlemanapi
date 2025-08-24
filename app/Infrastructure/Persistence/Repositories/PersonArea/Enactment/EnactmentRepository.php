<?php

namespace App\Infrastructure\Persistence\Repositories\PersonArea\Enactment;
use App\Domain\Interfaces\PersonArea\Enactment\IEnactmentRepository;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentMainCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentMinistrySignaturesEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentSubCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentSuggestResourcesEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentTypeBill85ReviewEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentTypeDeputyActionsEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentTypeEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentTypeGuardianCouncilEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentTypePromoteLawEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentTypePublicCourtEloquent;
use App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment\EnactmentTypeWorkflowCommissionEloquent;
use App\Infrastructure\Persistence\Repositories\Utility\Media\File\UploadRepository;
use Illuminate\Support\Facades\DB;

class EnactmentRepository implements IEnactmentRepository {

    public function list(array $filters){
        $query = EnactmentEloquent::query();

        $query->select(
            'enactment_id',
            'enactment_title',
            'enactment_content',
            'enactment_prev_title',
            'enactment_date',
            'enactment_president_letter_number',
            'president_name',
            'gov_period_name',
            'person_enactment.created_at',
            'person_enactment.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_enactment.enactment_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_enactment.enactment_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_enactment.enactment_parliament_period_id');
        if (!empty($filters['project_title'])) {
            $query->where('enactment_title', 'like', '%' . $filters['enactment_title'] . '%');
        }
        if (!empty($filters['enactment_president_id'])) {
            $query->where('enactment_president_id', 'like', '%' . $filters['enactment_president_id'] . '%');
        }
        if (!empty($filters['project_gov_period_id'])) {
            $query->where('enactment_gov_period_id', 'like', '%' . $filters['enactment_gov_period_id'] . '%');
        }
        if (!empty($filters['enactment_parliament_period_id'])) {
            $query->where('enactment_parliament_period_id', 'like', '%' . $filters['enactment_parliament_period_id'] . '%');
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
        $query = EnactmentEloquent::query();
        $query->select(
            'person_enactment.*',
            'president_name',
            'gov_period_name',
            'person_enactment.created_at',
            'person_enactment.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_enactment.enactment_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_enactment.enactment_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_enactment.enactment_parliament_period_id');
         $query->where('enactment_id', $id);
        $result = $query->get()->toArray();

        $result[0]['main_commission'] = $this->findMainCommissionById($result[0]['enactment_id']);
        $result[0]['sub_commission'] = $this->findSubCommissionById($result[0]['enactment_id']);
        $result[0]['ministry_signatures'] = $this->findMinistrySignaturesById($result[0]['enactment_id']);
        $result[0]['suggest_resources'] = $this->findSuggestResourcesById($result[0]['enactment_id']);
        $result[0]['enactment_type'] = $this->findTypeById($result[0]['enactment_id']);
        $result[0]['enactment_bill_85_review'] = $this->find85ById($result[0]['enactment_id']);
        $result[0]['enactment_deputy_actions'] = $this->findDeputyActionsById($result[0]['enactment_id']);
        $result[0]['enactment_guardian_council'] = $this->findGuardianCouncilById($result[0]['enactment_id']);
        $result[0]['enactment_promote_law'] = $this->findPromoteLawById($result[0]['enactment_id']);
        $result[0]['enactment_workflow_commission'] = $this->findWorkflowCommissionById($result[0]['enactment_id']);
        $result[0]['enactment_workflow_public_court'] = $this->findPublicCourtById($result[0]['enactment_id']);
        $result[0]['attachments'] = (new UploadRepository())->get_attachments($result[0]['enactment_id'], (new EnactmentEloquent()->getTable()));

        return $result;
    }
    public function create(array $data){

        return DB::transaction(function () use ($data) {
            $main_commission = $data['main_commission'];
            unset($data['main_commission']);
            $sub_commission = $data['sub_commission'];
            unset($data['sub_commission']);
            $ministry_signatures = $data['ministry_signatures'];
            unset($data['ministry_signatures']);
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
            $attachments = $data['attachments'];
            unset($data['attachments']);
            $result = EnactmentEloquent::create($data);

            foreach ($main_commission as $item) {
                EnactmentMainCommissionEloquent::create([
                    'enactment_id' => $result->enactment_id,
                    'commission_id' => $item
                ]);
            }
            foreach ($sub_commission as $item) {
                EnactmentSubCommissionEloquent::create([
                    'enactment_id' => $result->enactment_id,
                    'commission_id' => $item
                ]);
            }
            foreach ($ministry_signatures as $item) {
                EnactmentMinistrySignaturesEloquent::create([
                    'enactment_id' => $result->enactment_id,
                    'enactment_person_id' => $item
                ]);
            }
            foreach ($suggest_resources as $item) {
                EnactmentSuggestResourcesEloquent::create([
                    'enactment_id' => $result->enactment_id,
                    'suggester' => $item
                ]);
            }
            foreach ($type as $item) {
                EnactmentTypeEloquent::create(['enactment_id' => $result->enactment_id, 'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE)]);
            }
            foreach ($type_bill_85_review as $item) {
                EnactmentTypeBill85ReviewEloquent::create(['enactment_id' => $result->enactment_id, 'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE)]);
            }
            foreach ($type_deputy_actions as $item) {
                EnactmentTypeDeputyActionsEloquent::create(['enactment_id' => $result->enactment_id, 'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE)]);
            }
            foreach ($type_guardian_council as $item) {
                EnactmentTypeGuardianCouncilEloquent::create(['enactment_id' => $result->enactment_id, 'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE)]);
            }
            foreach ($type_promote_law as $item) {
                EnactmentTypePromoteLawEloquent::create(['enactment_id' => $result->enactment_id, 'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE)]);
            }
            foreach ($type_workflow_commission as $item) {
                EnactmentTypeWorkflowCommissionEloquent::create(['enactment_id' => $result->enactment_id, 'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE)]);
            }
            foreach ($type_workflow_public_court as $item) {
                EnactmentTypePublicCourtEloquent::create(['enactment_id' => $result->enactment_id, 'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE)]);
            }

             (new UploadRepository())->add_attachments($attachments, (new EnactmentEloquent()->getTable()), $result->enactment_id);

            return $result;
        });

    }
    public function update(array $data){

        $main_commission = $data['main_commission'];
        unset($data['main_commission']);
        $sub_commission = $data['sub_commission'];
        unset($data['sub_commission']);
        $ministry_signatures = $data['ministry_signatures'];
        unset($data['ministry_signatures']);
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
        $attachments = $data['attachments'];
        unset($data['attachments']);

        $result = EnactmentEloquent::where('enactment_id',$data['enactment_id'])->update(
            $data
        );

        EnactmentMainCommissionEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($main_commission as $item) {
            EnactmentMainCommissionEloquent::create([
                'enactment_id' => $data['enactment_id'],
                'commission_id' => $item
            ]);
        }
        EnactmentSubCommissionEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($sub_commission as $item) {
            EnactmentSubCommissionEloquent::create([
                'enactment_id' => $data['enactment_id'],
                'commission_id' => $item
            ]);
        }
        EnactmentSuggestResourcesEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($suggest_resources as $item) {
            EnactmentSuggestResourcesEloquent::create([
                'enactment_id' => $data['enactment_id'],
                'suggester' => $item
            ]);
        }
        EnactmentMinistrySignaturesEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($ministry_signatures as $item) {
            EnactmentMinistrySignaturesEloquent::create([
                'enactment_id' => $data['enactment_id'],
                'enactment_person_id' => $item
            ]);
        }
        EnactmentTypeEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($type as $item) {
            EnactmentTypeEloquent::create([ 'enactment_id' => $data['enactment_id'],  'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        EnactmentTypeBill85ReviewEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($type_bill_85_review as $item) {
            EnactmentTypeBill85ReviewEloquent::create([ 'enactment_id' => $data['enactment_id'],  'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        EnactmentTypeDeputyActionsEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($type_deputy_actions as $item) {
            EnactmentTypeDeputyActionsEloquent::create([ 'enactment_id' => $data['enactment_id'],  'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        EnactmentTypeGuardianCouncilEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($type_guardian_council as $item) {
            EnactmentTypeGuardianCouncilEloquent::create([ 'enactment_id' => $data['enactment_id'],  'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        EnactmentTypePromoteLawEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($type_promote_law as $item) {
            EnactmentTypePromoteLawEloquent::create([ 'enactment_id' => $data['enactment_id'],  'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        EnactmentTypeWorkflowCommissionEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($type_workflow_commission as $item) {
            EnactmentTypeWorkflowCommissionEloquent::create([ 'enactment_id' => $data['enactment_id'],  'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }
        EnactmentTypePublicCourtEloquent::where('enactment_id',$data['enactment_id'])->delete();
        foreach ($type_workflow_public_court as $item) {
            EnactmentTypePublicCourtEloquent::create([ 'enactment_id' => $data['enactment_id'],  'enactment_detail' => json_encode($item, JSON_UNESCAPED_UNICODE) ]);
        }

        (new UploadRepository())->add_attachments($attachments, (new EnactmentEloquent()->getTable()), $data['enactment_id']);

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
        return EnactmentMainCommissionEloquent::query()->select('commission_id')->where('enactment_id',$id)->get()->toArray();
    }
    public function findSubCommissionById(int $id){
        return EnactmentSubCommissionEloquent::query()->select('commission_id')->where('enactment_id',$id)->get()->toArray();
    }
    public function findMinistrySignaturesById(int $id){
        return EnactmentMinistrySignaturesEloquent::query()->select('enactment_person_id')->where('enactment_id',$id)->get()->toArray();
    }
    public function findSuggestResourcesById(int $id){
        return EnactmentSuggestResourcesEloquent::query()->select('suggester')->where('enactment_id',$id)->get()->toArray();
    }
    public function findTypeById(int $id){
        return EnactmentTypeEloquent::query()->select('enactment_detail')->where('enactment_id',$id)->get()->toArray();
    }
    public function find85ById(int $id){
        return EnactmentTypeBill85ReviewEloquent::query()->select('enactment_detail')->where('enactment_id',$id)->get()->toArray();
    }
    public function findDeputyActionsById(int $id){
        return EnactmentTypeDeputyActionsEloquent::query()->select('enactment_detail')->where('enactment_id',$id)->get()->toArray();
    }
    public function findPromoteLawById(int $id){
        return EnactmentTypePromoteLawEloquent::query()->select('enactment_detail')->where('enactment_id',$id)->get()->toArray();
    }
    public function findGuardianCouncilById(int $id){
        return EnactmentTypeGuardianCouncilEloquent::query()->select('enactment_detail')->where('enactment_id',$id)->get()->toArray();
    }
    public function findWorkflowCommissionById(int $id){
        return EnactmentTypeWorkflowCommissionEloquent::query()->select('enactment_detail')->where('enactment_id',$id)->get()->toArray();
    }
    public function findPublicCourtById(int $id){
        return EnactmentTypePublicCourtEloquent::query()->select('enactment_detail')->where('enactment_id',$id)->get()->toArray();
    }
}
