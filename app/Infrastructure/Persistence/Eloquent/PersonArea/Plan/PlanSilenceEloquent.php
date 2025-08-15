<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanSilenceEloquent extends Model{
    protected $table = 'person_plan_silence';
    protected $primaryKey = 'plan_id';
    protected $guarded = [];
}
