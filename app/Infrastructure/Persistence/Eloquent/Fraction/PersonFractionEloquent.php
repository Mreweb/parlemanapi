<?php

namespace App\Infrastructure\Persistence\Eloquent\Fraction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonFractionEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_fraction';
    protected $primaryKey = 'row_id';
    protected $fillable = ['person_id', 'fraction_id'];
}
