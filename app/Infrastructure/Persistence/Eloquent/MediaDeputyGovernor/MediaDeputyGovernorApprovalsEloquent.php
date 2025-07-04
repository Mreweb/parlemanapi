<?php

namespace App\Infrastructure\Persistence\Eloquent\MediaDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
MediaDeputyGovernorApprovalsEloquent extends Model{
    protected $table = 'person_deputy_governor_media_approvals';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
