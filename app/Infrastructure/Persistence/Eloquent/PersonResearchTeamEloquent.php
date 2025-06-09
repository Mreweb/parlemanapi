<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;

class PersonResearchTeamEloquent extends Model{
    protected $table = 'person_research_team';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
