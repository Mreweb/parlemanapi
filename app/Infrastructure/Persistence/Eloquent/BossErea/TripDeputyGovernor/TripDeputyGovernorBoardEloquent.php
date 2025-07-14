<?php

namespace App\Infrastructure\Persistence\Eloquent\TripDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
TripDeputyGovernorBoardEloquent extends Model{
    protected $table = 'person_deputy_governor_trip_board';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
