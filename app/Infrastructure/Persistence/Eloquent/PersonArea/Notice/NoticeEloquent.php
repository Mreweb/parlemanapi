<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Notice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class NoticeEloquent extends Model{
    use SoftDeletes;
    protected $table = 'person_notice';
    protected $primaryKey = 'notice_id';
    protected $guarded = [];
    public function scope_notice_subject(Builder $query , $filters){
        if (!empty($filters['notice_subject'])) {
            $query->where('notice_subject', 'like', '%' . $filters['notice_subject'] . '%');
        }
    }
}
