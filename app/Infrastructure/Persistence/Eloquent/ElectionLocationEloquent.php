<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ElectionLocationEloquent extends Model{

    use SoftDeletes;
    protected $table = 'election_location';
    protected $primaryKey = 'election_location_id';
    protected $fillable = [
        'election_location_title',
        'election_location_province_id',
        'election_location_cities'
    ];

}
