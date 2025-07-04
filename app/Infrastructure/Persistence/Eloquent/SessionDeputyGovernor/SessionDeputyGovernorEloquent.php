<?php

namespace App\Infrastructure\Persistence\Eloquent\SessionDeputyGovernor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
SessionDeputyGovernorEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_deputy_governor_session';
    protected $primaryKey = 'session_id';
    protected $guarded = [];
}
