<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\VoteConfidence;

use App\Infrastructure\Persistence\Eloquent\PersonArea\Person\PersonEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteConfidenceEloquent extends Model
{
    use SoftDeletes;

    protected $table = 'person_vote_confidence';
    protected $primaryKey = 'vote_confidence_id';
    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(PersonEloquent::class, 'person_id');
    }
}
