<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanPublicCourtEloquent extends Model{
    protected $table = 'person_plan_workflow_public_court';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
