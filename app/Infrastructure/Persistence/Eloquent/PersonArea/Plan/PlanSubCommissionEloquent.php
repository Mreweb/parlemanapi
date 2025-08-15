<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanSubCommissionEloquent extends Model{
    protected $table = 'person_plan_sub_commission';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
