<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanTypeEloquent extends Model{
    protected $table = 'person_plan_type';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
