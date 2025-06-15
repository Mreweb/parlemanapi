<?php

namespace App\Infrastructure\Persistence\Eloquent\Meeting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonMeetingEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_meeting';
    protected $primaryKey = 'meeting_id';
    protected $guarded = [];
}
