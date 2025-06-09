<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;

class RuleTTFEloquent extends Model{
    protected $table = 'rule_ttf';
    protected $primaryKey = 'rule_ttf_id';
    protected $guarded = [];
}
