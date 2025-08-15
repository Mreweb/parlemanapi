<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;

class EnactmentTypeGuardianCouncilEloquent extends Model{
    protected $table = 'person_enactment_type_guardian_council';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
