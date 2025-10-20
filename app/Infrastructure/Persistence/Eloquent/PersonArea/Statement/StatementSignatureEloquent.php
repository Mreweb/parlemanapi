<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Statement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatementSignatureEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_statement_signature';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
