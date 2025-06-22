<?php

namespace App\Infrastructure\Persistence\Repositories\Projects;
use App\Domain\Interfaces\IProjectsRepository;
use App\Infrastructure\Persistence\Eloquent\Project\ProjectParticipationEloquent;
use App\Infrastructure\Persistence\Eloquent\Project\ProjectRelatedCommissionEloquent;
use App\Infrastructure\Persistence\Eloquent\Project\ProjectsEloquent;
use App\Infrastructure\Persistence\Eloquent\Project\ProjectSpecialCommissionEloquent;
use Illuminate\Support\Facades\DB;

class ProjectsRepository implements IProjectsRepository {

    public function list(array $filters){
        $query = ProjectsEloquent::query();
        $query->select(
            'project_id',
            'project_title',
            'project_register_number',
            'project_create_date',
            'project_priority',
            'project_handle_way',
            'project_topic_relevance',
            'project_government_vote',
            'project_status',
            'project_end_date',
            'president_name',
            'gov_period_name',
            'person_projects.created_at',
            'person_projects.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_projects.project_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_projects.project_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_projects.project_parliament_period_id');
        if (!empty($filters['project_title'])) {
            $query->where('project_title', 'like', '%' . $filters['project_title'] . '%');
        }
        if (!empty($filters['project_president_id'])) {
            $query->where('project_president_id', 'like', '%' . $filters['project_president_id'] . '%');
        }
        if (!empty($filters['project_gov_period_id'])) {
            $query->where('project_gov_period_id', 'like', '%' . $filters['project_gov_period_id'] . '%');
        }
        if (!empty($filters['project_parliament_period_id'])) {
            $query->where('project_parliament_period_id', 'like', '%' . $filters['project_parliament_period_id'] . '%');
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
        $query = ProjectsEloquent::query();
        $query->select(
            'person_projects.*',
            'president_name',
            'gov_period_name',
            'person_projects.created_at',
            'person_projects.updated_at');
        $query->leftJoin('president', 'president.president_id', '=', 'person_projects.project_president_id');
        $query->leftJoin('gov_period', 'gov_period.gov_period_id', '=', 'person_projects.project_gov_period_id');
        $query->leftJoin('parleman_period', 'parleman_period.period_id', '=', 'person_projects.project_parliament_period_id');
         $query->where('project_id', $id);
        $result = $query->get()->toArray();

        $result[0]['person_projects_participation_ids'] = $this->findParticipationById($result[0]['project_id']);
        $result[0]['person_projects_related_commission_ids'] = $this->findParticipationById($result[0]['project_id']);
        $result[0]['person_projects_special_commission_ids'] = $this->findParticipationById($result[0]['project_id']);

        return $result;
    }
    public function create(array $data){
        $person_projects_participation_ids = $data['person_projects_participation_ids'];
        $person_projects_related_commission_ids = $data['person_projects_related_commission_ids'];
        $person_projects_special_commission_ids  = $data['person_projects_special_commission_ids'];
        unset($data['person_projects_participation_ids']);
        unset($data['person_projects_related_commission_ids']);
        unset($data['person_projects_special_commission_ids']);
        $result =  ProjectsEloquent::create($data);


        foreach ($person_projects_participation_ids as $signature_person_id) {
            ProjectParticipationEloquent::create(
                [
                    'projects_project_id' => $result->project_id,
                    'projects_participation_person_id' => $signature_person_id
                ]
            );
        }
        foreach ($person_projects_related_commission_ids as $signature_person_id) {
            ProjectRelatedCommissionEloquent::create(
                [
                    'projects_project_id' => $result->project_id,
                    'projects_related_commission_id' => $signature_person_id
                ]
            );
        }
        foreach ($person_projects_special_commission_ids as $signature_person_id) {
            ProjectSpecialCommissionEloquent::create(
                [
                    'projects_project_id' => $result->project_id,
                    'projects_special_commission_id' => $signature_person_id
                ]
            );
        }
        return $result;

    }
    public function update(array $data){

        $person_projects_participation_ids = $data['person_projects_participation_ids'];
        $person_projects_related_commission_ids = $data['person_projects_related_commission_ids'];
        $person_projects_special_commission_ids  = $data['person_projects_special_commission_ids'];
        unset($data['person_projects_participation_ids']);
        unset($data['person_projects_related_commission_ids']);
        unset($data['person_projects_special_commission_ids']);

        $result = ProjectsEloquent::where('project_id',$data['project_id'])->update(
            $data
        );


        ProjectParticipationEloquent::where('projects_project_id',$data['project_id'])->delete();
        foreach ($person_projects_participation_ids as $signature_person_id) {
            ProjectParticipationEloquent::create(
                [
                    'projects_project_id' =>$data['project_id'],
                    'projects_participation_person_id' => $signature_person_id
                ]
            );
        }
        ProjectRelatedCommissionEloquent::where('projects_project_id',$data['project_id'])->delete();
        foreach ($person_projects_related_commission_ids as $signature_person_id) {
            ProjectRelatedCommissionEloquent::create(
                [
                    'projects_project_id' => $data['project_id'],
                    'projects_related_commission_id' => $signature_person_id
                ]
            );
        }
        ProjectSpecialCommissionEloquent::where('projects_project_id',$data['project_id'])->delete();
        foreach ($person_projects_special_commission_ids as $signature_person_id) {
            ProjectSpecialCommissionEloquent::create(
                [
                    'projects_project_id' => $data['project_id'],
                    'projects_special_commission_id' => $signature_person_id
                ]
            );
        }
        return $result;


    }
    public function delete(int $id){
        $city = $this->findById($id);
        if($city){
            return ProjectsEloquent::findOrFail($id)->delete();
        } else{
            return false;
        }
    }

    public function findParticipationById(int $id){
        return ProjectParticipationEloquent::query()->select('projects_participation_person_id as person_id')->where('projects_project_id',$id)->get()->toArray();

    }
    public function findRelatedCommissionById(int $id)
    {
        return ProjectRelatedCommissionEloquent::query()->select('projects_related_commission_id as person_id')->where('projects_project_id',$id)->get()->toArray();

    }
    public function findSpecialById(int $id)
    {
        return ProjectSpecialCommissionEloquent::query()->select('projects_special_commission_id as person_id')->where('projects_project_id',$id)->get()->toArray();
    }
}
