<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_question';
    protected $primaryKey = 'question_id';
    protected $guarded = [];
}
