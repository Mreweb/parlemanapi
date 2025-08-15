<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;

class EnactmentTypePromoteLawEloquent extends Model{
    protected $table = 'person_enactment_type_promote_law';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
