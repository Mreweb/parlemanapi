<?php

namespace App\Infrastructure\Persistence\Eloquent\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectsEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_projects';
    protected $primaryKey = 'project_id';
    protected $guarded = [];
}
