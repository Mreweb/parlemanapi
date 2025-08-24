<?php

namespace App\Infrastructure\Persistence\Eloquent\PersonArea\Interpellation;
use Illuminate\Database\Eloquent\Model;

class InterpellationAttachmentEloquent extends Model{
    protected $table = 'person_interpellation_attachment';
    protected $primaryKey = 'row_id';
    protected $guarded = [];
 }
