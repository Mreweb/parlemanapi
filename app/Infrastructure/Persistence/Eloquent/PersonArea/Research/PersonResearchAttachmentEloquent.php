<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Research;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonResearchAttachmentEloquent extends Model{
    protected $table = 'person_research_attachment';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
    protected $fillable = ['person_research_attachment_title','person_research_attachment_src','person_research_id'];
}
