<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;

class EnactmentTypePublicCourtEloquent extends Model{
    protected $table = 'person_enactment_type_workflow_public_court';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
