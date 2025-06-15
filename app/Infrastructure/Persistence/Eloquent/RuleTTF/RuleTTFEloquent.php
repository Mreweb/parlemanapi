<?php

namespace App\Infrastructure\Persistence\Eloquent\RuleTTF;
use Illuminate\Database\Eloquent\Model;

class RuleTTFEloquent extends Model{
    protected $table = 'person_rule_ttf';
    protected $primaryKey = 'rule_ttf_id';
    protected $guarded = [];
}
