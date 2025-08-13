<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnactmentMinistrySignaturesEloquent extends Model{
    protected $table = 'person_enactment_ministry_signatures';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
