<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectSpecialCommissionEloquent extends Model{
    protected $table = 'person_projects_special_commission';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
