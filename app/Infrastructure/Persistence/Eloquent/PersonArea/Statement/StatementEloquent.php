<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Statement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatementEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_statement';
    protected $primaryKey = 'statement_id';
    protected $guarded = [];
}
