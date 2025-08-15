<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanMainCommissionEloquent extends Model{
    protected $table = 'person_plan_main_commission';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
