<?php

namespace App\Infrastructure\Persistence\Eloquent\Fraction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FractionEloquent extends Model{
    use SoftDeletes;
    protected $table = 'fraction';
    protected $primaryKey = 'fraction_id';
    protected $fillable = ['fraction_name'];
}
