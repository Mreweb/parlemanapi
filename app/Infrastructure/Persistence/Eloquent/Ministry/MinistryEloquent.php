<?php

namespace App\Infrastructure\Persistence\Eloquent\Ministry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MinistryEloquent extends Model{
    use SoftDeletes;
    protected $table = 'ministry';
    protected $primaryKey = 'ministry_id';
    protected $fillable = ['ministry_name'];
}
