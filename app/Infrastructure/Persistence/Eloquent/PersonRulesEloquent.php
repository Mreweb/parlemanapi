<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonRulesEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_rules';
    protected $primaryKey = 'rule_id';
    protected $guarded = [];
}
