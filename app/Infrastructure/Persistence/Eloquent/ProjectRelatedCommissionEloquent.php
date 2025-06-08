<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectRelatedCommissionEloquent extends Model{
    protected $table = 'person_projects_related_commission';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
