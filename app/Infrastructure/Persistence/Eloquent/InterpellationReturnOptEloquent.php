<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterpellationReturnOptEloquent extends Model{
    protected $table = 'interpellation_return_opt';
    protected $primaryKey = 'interpellation_return_opt_id';
    protected $guarded = [];
    protected $fillable = ['interpellation_id','interpellation_return_opt_person_id'];
}
