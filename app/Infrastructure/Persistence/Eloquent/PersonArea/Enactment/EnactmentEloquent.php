<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnactmentEloquent extends Model{
    protected $table = 'person_enactment';
    protected $primaryKey = 'enactment_id';
    protected $guarded = [];
}
