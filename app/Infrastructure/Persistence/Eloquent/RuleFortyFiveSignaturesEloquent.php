<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;

class RuleFortyFiveSignaturesEloquent extends Model{
    protected $table = 'rule_forty_five_signatures';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
