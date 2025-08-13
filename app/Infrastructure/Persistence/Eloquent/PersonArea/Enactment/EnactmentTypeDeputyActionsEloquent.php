<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;

class EnactmentTypeDeputyActionsEloquent extends Model{
    protected $table = 'person_enactment_type_deputy_actions';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
