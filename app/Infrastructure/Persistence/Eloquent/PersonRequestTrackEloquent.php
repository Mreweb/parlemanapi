<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonRequestTrackEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_requests_track';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
