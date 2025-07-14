<?php

namespace App\Infrastructure\Persistence\Eloquent\MediaDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
MediaDeputyGovernorActionsEloquent extends Model{
    protected $table = 'person_deputy_governor_media_actions';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
