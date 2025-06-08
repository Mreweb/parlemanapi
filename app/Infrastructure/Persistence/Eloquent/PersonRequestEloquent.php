<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonRequestEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_requests';
    protected $primaryKey = 'request_id';
    protected $guarded = [];
}
