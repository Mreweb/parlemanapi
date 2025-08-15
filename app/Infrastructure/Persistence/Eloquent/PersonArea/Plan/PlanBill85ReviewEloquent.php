<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanBill85ReviewEloquent extends Model{
    protected $table = 'person_plan_bill_85_review';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
