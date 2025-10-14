<?php

namespace App\Infrastructure\Persistence\Eloquent\Common\Fraction;

use App\Infrastructure\Persistence\Eloquent\PersonArea\Person\PersonEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonFractionEloquent extends Model
{
    use SoftDeletes;

    protected $table = 'person_fraction';
    protected $primaryKey = 'row_id';
    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(PersonEloquent::class, 'person_id');
    }

    public function fraction()
    {
        return $this->belongsTo(FractionEloquent::class, 'fraction_id');
    }
}
