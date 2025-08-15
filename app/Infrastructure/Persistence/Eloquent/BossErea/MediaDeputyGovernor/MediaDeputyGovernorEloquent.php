<?php

namespace App\Infrastructure\Persistence\Eloquent\BossErea\MediaDeputyGovernor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
MediaDeputyGovernorEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_deputy_governor_media';
    protected $primaryKey = 'media_id';
    protected $guarded = [];
}
