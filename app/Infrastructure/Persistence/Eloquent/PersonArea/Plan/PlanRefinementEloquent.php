<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanRefinementEloquent extends Model{
    protected $table = 'person_plan_refinement';
    protected $primaryKey = 'plan_id';
    protected $guarded = [];
}
