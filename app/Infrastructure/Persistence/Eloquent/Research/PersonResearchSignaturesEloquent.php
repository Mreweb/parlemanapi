<?php

namespace App\Infrastructure\Persistence\Eloquent\Research;
use Illuminate\Database\Eloquent\Model;

class PersonResearchSignaturesEloquent extends Model{
    protected $table = 'person_research_signatures';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
