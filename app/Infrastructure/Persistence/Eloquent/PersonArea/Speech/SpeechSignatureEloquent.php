<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Speech;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpeechSignatureEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_speech_signature';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
