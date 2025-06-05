<?php

namespace App\Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticeEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_notice';
    protected $primaryKey = 'notice_id';
    protected $guarded = [];
}
