<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person';
    protected $primaryKey = 'person_id';
    //All Filed Are Fillable so there is no fillable array
    //protected $fillable = [];
    protected $guarded = [];
}
