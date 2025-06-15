<?php

namespace App\Infrastructure\Persistence\Eloquent\Interpellation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterpellationOptEloquent extends Model{
    protected $table = 'person_interpellation_opt';
    protected $primaryKey = 'interpellation_opt_id';
    protected $guarded = [];
    protected $fillable = ['interpellation_id','interpellation_opt_person_id'];
}
