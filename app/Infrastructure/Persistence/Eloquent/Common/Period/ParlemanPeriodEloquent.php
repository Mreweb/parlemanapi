<?php

namespace App\Infrastructure\Persistence\Eloquent\Period;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParlemanPeriodEloquent extends Model{
    use SoftDeletes;
    protected $table = 'parleman_period';
    protected $primaryKey = 'period_id';
    protected $fillable = ['period_title'];
}
