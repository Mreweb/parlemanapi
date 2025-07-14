<?php

namespace App\Infrastructure\Persistence\Eloquent\TripDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
TripDeputyGovernorActionsEloquent extends Model{
    protected $table = 'person_deputy_governor_trip_actions';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
