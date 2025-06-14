<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuleFortyFiveEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_rule_forty_five';
    protected $primaryKey = 'rule_forty_five_id';
    protected $guarded = [];
}
