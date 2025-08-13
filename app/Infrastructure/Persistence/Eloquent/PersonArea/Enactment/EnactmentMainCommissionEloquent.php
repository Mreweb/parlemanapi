<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnactmentMainCommissionEloquent extends Model{
    protected $table = 'person_enactment_main_commission';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
