<?php

namespace App\Infrastructure\Persistence\Eloquent\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
TripBoardEloquent extends Model{
    protected $table = 'person_trip_board';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
