<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanEloquent extends Model{
    protected $table = 'person_plan';
    protected $primaryKey = 'plan_id';
    protected $guarded = [];
}
