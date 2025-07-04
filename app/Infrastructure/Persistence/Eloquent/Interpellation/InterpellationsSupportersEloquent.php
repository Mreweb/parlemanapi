<?php

namespace App\Infrastructure\Persistence\Eloquent\Interpellation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterpellationsSupportersEloquent extends Model{
    protected $table = 'person_interpellation_supporters';
    protected $primaryKey = 'interpellation_supporter_id';
    protected $guarded = [];
    protected $fillable = ['interpellation_id','interpellation_supporter_person_id'];
}
