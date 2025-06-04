<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadEloquent extends Model{
    use SoftDeletes;

    protected $casts = [
        'media_id' => 'string'
    ];
    protected $table = 'media';
    protected $primaryKey = 'media_id';
    protected $fillable = ['media_id' , 'path', 'extension'];
}
