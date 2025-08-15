<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Enactment;
use Illuminate\Database\Eloquent\Model;

class EnactmentSuggestResourcesEloquent extends Model{
    protected $table = 'person_enactment_suggest_resources';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
