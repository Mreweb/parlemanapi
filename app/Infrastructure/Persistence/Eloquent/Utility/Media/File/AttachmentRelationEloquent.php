<?php

namespace App\Infrastructure\Persistence\Eloquent\Utility\Media\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachmentRelationEloquent extends Model{
    protected $casts = [
        'attachment_id' => 'string'
    ];
    protected $table = 'attachments_relation';
    protected $primaryKey = 'attachment_id';
    protected $fillable = ['attachment_id' ,'worksheet_title' , 'worksheet_id'];
}
