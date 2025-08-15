<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanPromoteLawEloquent extends Model{
    protected $table = 'person_plan_promote_law';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
