<?php

namespace App\Infrastructure\Persistence\Eloquent\RuleFortyFive;
use Illuminate\Database\Eloquent\Model;

class RuleFortyFiveSignaturesEloquent extends Model{
    protected $table = 'person_rule_forty_five_signatures';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
