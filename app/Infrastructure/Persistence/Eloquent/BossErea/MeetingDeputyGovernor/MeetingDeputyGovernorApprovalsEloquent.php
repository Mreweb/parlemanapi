<?php

namespace App\Infrastructure\Persistence\Eloquent\MeetingDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
MeetingDeputyGovernorApprovalsEloquent extends Model{
    protected $table = 'person_deputy_governor_meeting_approvals';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
