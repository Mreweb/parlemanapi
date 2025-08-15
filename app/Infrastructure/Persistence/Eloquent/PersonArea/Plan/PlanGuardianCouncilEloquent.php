<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanGuardianCouncilEloquent extends Model{
    protected $table = 'person_plan_guardian_council';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
