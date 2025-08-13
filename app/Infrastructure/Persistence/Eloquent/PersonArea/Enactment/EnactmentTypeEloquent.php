<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;

class EnactmentTypeEloquent extends Model{
    protected $table = 'person_enactment_type';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
