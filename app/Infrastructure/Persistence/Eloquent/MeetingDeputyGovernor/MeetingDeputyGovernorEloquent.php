<?php

namespace App\Infrastructure\Persistence\Eloquent\MeetingDeputyGovernor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
MeetingDeputyGovernorEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_deputy_governor_meeting';
    protected $primaryKey = 'meeting_id';
    protected $guarded = [];
}
