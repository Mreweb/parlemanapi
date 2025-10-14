<?php

namespace App\Infrastructure\Persistence\Eloquent\Common\Commission;

use App\Infrastructure\Persistence\Eloquent\PersonArea\Person\PersonEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonCommissionEloquent extends Model
{
    use SoftDeletes;

    protected $table = 'person_commission';
    protected $primaryKey = 'row_id';
    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(PersonEloquent::class, 'person_id', 'person_id');
    }

    public function commission()
    {
        return $this->belongsTo(CommissionEloquent::class, 'commission_id', 'commission_id');
    }
}
