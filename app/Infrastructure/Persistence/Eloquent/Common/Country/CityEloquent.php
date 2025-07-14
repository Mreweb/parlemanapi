<?php

namespace App\Infrastructure\Persistence\Eloquent\Country;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityEloquent extends Model{
    use SoftDeletes;

    protected $table = 'city';
    protected $primaryKey = 'city_id';
    protected $fillable = ['city_name', 'city_province_id'];
    public function province(){
        return $this->belongsTo(ProvinceEloquent::class, 'province_id', 'city_province_id');
    }
}
