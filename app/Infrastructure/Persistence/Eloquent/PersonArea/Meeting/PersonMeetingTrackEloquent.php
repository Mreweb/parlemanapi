<?php

namespace App\Infrastructure\Persistence\Eloquent\Meeting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonMeetingTrackEloquent extends Model{
    protected $table = 'person_meeting_track';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
