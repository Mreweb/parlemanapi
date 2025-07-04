<?php

namespace App\Infrastructure\Persistence\Eloquent\MediaDeputyGovernor;
use Illuminate\Database\Eloquent\Model;

class
MediaDeputyGovernorBoardEloquent extends Model{
    protected $table = 'person_deputy_governor_media_board';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
