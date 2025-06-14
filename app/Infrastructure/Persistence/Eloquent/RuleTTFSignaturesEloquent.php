<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;

class RuleTTFSignaturesEloquent extends Model{
    protected $table = 'person_rule_ttf_signatures';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
