<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;

class EnactmentTypeWorkflowCommissionEloquent extends Model{
    protected $table = 'person_enactment_type_workflow_commission';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
