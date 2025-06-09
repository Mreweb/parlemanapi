<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonResearchEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_research';
    protected $primaryKey = 'person_research_id';
    protected $guarded = [];
}
