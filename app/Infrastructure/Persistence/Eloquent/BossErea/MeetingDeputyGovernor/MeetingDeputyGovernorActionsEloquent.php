<?php

namespace App\Infrastructure\Persistence\Eloquent\MeetingDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
MeetingDeputyGovernorActionsEloquent extends Model{
    protected $table = 'person_deputy_governor_meeting_actions';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
