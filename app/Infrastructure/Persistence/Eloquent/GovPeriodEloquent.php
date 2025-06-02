<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GovPeriodEloquent extends Model{
    use SoftDeletes;
    protected $table = 'gov_period';
    protected $primaryKey = 'gov_period_id';
    protected $fillable = ['gov_period_name'];
}
