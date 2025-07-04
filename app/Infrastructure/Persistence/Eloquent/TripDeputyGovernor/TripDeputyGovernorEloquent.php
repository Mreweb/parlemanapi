<?php

namespace App\Infrastructure\Persistence\Eloquent\TripDeputyGovernor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
TripDeputyGovernorEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_deputy_governor_trip';
    protected $primaryKey = 'trip_id';
    protected $guarded = [];
}
