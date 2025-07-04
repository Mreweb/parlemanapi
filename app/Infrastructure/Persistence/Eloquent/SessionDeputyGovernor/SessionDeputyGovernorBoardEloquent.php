<?php

namespace App\Infrastructure\Persistence\Eloquent\SessionDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
SessionDeputyGovernorBoardEloquent extends Model{
    protected $table = 'person_deputy_governor_session_board';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
