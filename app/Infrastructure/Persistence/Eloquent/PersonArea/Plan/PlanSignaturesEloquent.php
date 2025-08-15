<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanSignaturesEloquent extends Model{
    protected $table = 'person_plan_signatures';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
