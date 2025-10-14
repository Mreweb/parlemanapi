<?php

namespace App\Infrastructure\Persistence\Eloquent\Common\Election;

use App\Infrastructure\Persistence\Eloquent\PersonArea\Person\PersonEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonElectionEloquent extends Model
{
    use SoftDeletes;

    protected $table = 'person_election';
    protected $primaryKey = 'row_id';
    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(PersonEloquent::class, 'person_id', 'person_id');
    }

    public function electionLocation()
    {
        return $this->belongsTo(ElectionLocationEloquent::class, 'election_id', 'election_location_id');
    }
}
