<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
TripEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_trip';
    protected $primaryKey = 'trip_id';
    protected $guarded = [];
}
