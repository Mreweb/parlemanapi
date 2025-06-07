<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonElectionEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_election';
    protected $primaryKey = 'row_id';
    protected $fillable = ['person_id', 'election_id'];
}
