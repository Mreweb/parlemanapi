<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanDeputyActionsEloquent extends Model{
    protected $table = 'person_plan_deputy_actions';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
