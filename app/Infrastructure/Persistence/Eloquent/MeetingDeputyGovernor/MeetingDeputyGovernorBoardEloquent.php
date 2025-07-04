<?php

namespace App\Infrastructure\Persistence\Eloquent\MeetingDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
MeetingDeputyGovernorBoardEloquent extends Model{
    protected $table = 'person_deputy_governor_meeting_board';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
