<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommissionEloquent extends Model{
    use SoftDeletes;
    protected $table = 'commission';
    protected $primaryKey = 'commission_id';
    protected $fillable = ['commission_name'];
}
