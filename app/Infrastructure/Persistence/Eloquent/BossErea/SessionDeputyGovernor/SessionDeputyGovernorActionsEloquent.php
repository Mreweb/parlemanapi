<?php

namespace App\Infrastructure\Persistence\Eloquent\SessionDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
SessionDeputyGovernorActionsEloquent extends Model{
    protected $table = 'person_deputy_governor_session_actions';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
