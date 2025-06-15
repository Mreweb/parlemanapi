<?php

namespace App\Infrastructure\Persistence\Eloquent\President;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresidentCabinetEloquent extends Model{
    use SoftDeletes;
    protected $table = 'president_cabinet';
    protected $primaryKey = 'row_id';
    protected $fillable = ['cabinet' , 'president_id', 'cabinet_person_id'];
}
