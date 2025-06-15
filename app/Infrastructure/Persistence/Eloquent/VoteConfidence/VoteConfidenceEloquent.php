<?php

namespace App\Infrastructure\Persistence\Eloquent\VoteConfidence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteConfidenceEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_vote_confidence';
    protected $primaryKey = 'vote_confidence_id';
    protected $guarded = [];
}
