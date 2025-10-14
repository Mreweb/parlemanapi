<?php

namespace App\Infrastructure\Persistence\Eloquent\Utility\Media\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadEloquent extends Model{
    use SoftDeletes;

    protected $casts = [
        'attachment_id' => 'string'
    ];
    protected $table = 'attachments';
    protected $primaryKey = 'row_id';
    protected $fillable = ['attachment_id' , 'attachment_title' , 'path', 'extension','base_64'];
}
