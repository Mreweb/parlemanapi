<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectParticipationEloquent extends Model{
    protected $table = 'person_projects_participation';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
