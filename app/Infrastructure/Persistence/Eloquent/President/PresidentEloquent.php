<?php

namespace App\Infrastructure\Persistence\Eloquent\President;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresidentEloquent extends Model{
    use SoftDeletes;
    protected $table = 'president';
    protected $primaryKey = 'president_id';
    protected $fillable = ['president_name'];
}
