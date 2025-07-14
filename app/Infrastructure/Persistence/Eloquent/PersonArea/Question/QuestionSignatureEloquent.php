<?php

namespace App\Infrastructure\Persistence\Eloquent\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionSignatureEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_question_signature';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
