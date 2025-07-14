<?php

namespace App\Infrastructure\Persistence\Eloquent\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
TripApprovalsEloquent extends Model{
    protected $table = 'person_trip_approvals';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
