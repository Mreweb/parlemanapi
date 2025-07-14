<?php

namespace App\Infrastructure\Persistence\Eloquent\Notice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticeSignatureEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_notice_signature';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
}
