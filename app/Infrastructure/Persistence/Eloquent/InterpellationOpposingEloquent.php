<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterpellationOpposingEloquent extends Model{
    protected $table = 'person_interpellations_opposing';
    protected $primaryKey = 'interpellations_opposing_id';
    protected $guarded = [];
    protected $fillable = ['interpellation_id','interpellations_opposing_person_id'];
}
