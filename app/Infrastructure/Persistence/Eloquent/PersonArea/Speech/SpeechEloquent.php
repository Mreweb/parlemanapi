<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Speech;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpeechEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_speech';
    protected $primaryKey = 'speech_id';
    protected $guarded = [];
}
