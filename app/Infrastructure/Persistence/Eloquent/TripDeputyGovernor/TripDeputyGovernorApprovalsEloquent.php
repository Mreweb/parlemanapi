<?php

namespace App\Infrastructure\Persistence\Eloquent\TripDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
TripDeputyGovernorApprovalsEloquent extends Model{
    protected $table = 'person_deputy_governor_trip_approvals';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
