<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Person;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person';
    protected $primaryKey = 'person_id';
    protected $guarded = [];

}
