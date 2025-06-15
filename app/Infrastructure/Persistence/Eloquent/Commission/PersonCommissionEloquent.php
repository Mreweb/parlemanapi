<?php

namespace App\Infrastructure\Persistence\Eloquent\Commission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonCommissionEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_commission';
    protected $primaryKey = 'row_id';
    protected $fillable = ['person_id', 'commission_id'];
}
