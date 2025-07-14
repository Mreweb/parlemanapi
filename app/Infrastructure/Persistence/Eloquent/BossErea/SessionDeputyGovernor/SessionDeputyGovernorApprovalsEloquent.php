<?php

namespace App\Infrastructure\Persistence\Eloquent\SessionDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
SessionDeputyGovernorApprovalsEloquent extends Model{
    protected $table = 'person_deputy_governor_session_approvals';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
