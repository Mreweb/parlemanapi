<?php

namespace App\Infrastructure\Persistence\Eloquent\Interpellation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterpellationsEloquent extends Model{
    protected $table = 'person_interpellations';
    protected $primaryKey = 'interpellation_id';
    protected $guarded = [];
}
