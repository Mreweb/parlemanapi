<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanWorkflowCommissionEloquent extends Model{
    protected $table = 'person_plan_workflow_commission';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
