<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;

class EnactmentTypeBill85ReviewEloquent extends Model{
    protected $table = 'person_enactment_type_bill_85_review';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
