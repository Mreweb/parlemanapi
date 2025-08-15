<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanSuggestResourcesEloquent extends Model{
    protected $table = 'person_plan_suggest_resources';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
