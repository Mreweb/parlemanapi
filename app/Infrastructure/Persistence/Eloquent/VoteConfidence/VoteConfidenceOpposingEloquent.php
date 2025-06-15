<?php

namespace App\Infrastructure\Persistence\Eloquent\VoteConfidence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteConfidenceOpposingEloquent extends Model{
    protected $table = 'person_vote_confidence_opposing';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
    protected $fillable = ['vote_confidence_id','vote_confidence_opposing_person_id'];
}
