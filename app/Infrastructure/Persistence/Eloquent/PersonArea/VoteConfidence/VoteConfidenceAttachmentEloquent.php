<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\VoteConfidence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteConfidenceAttachmentEloquent extends Model{
    protected $table = 'person_vote_confidence_attachment';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
    protected $fillable = ['vote_confidence_attachment_title','vote_confidence_attachment_src','vote_confidence_id'];
}
