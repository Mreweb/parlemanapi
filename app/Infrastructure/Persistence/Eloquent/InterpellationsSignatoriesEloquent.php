<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterpellationsSignatoriesEloquent extends Model{
    protected $table = 'interpellation_signatories';
    protected $primaryKey = 'interpellation_signature_id';
    protected $guarded = [];
    protected $fillable = ['interpellation_id','interpellation_signature_person_id'];
}
