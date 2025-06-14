<?php

namespace App\Infrastructure\Persistence\Eloquent\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
TripActionsEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_trip_actions';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
