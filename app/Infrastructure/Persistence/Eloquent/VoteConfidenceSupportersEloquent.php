<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteConfidenceSupportersEloquent extends Model{
    protected $table = 'person_vote_confidence_supporters';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
    protected $fillable = ['vote_confidence_id','vote_confidence_supporters_person_id'];
}
