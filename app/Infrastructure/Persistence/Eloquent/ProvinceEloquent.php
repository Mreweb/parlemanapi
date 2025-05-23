<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProvinceEloquent extends Model{
    use SoftDeletes;
    protected $table = 'province';
    protected $primaryKey = 'province_id';
    protected $fillable = ['province_name' , 'province_id' ];
    public function cities(){
        return $this->hasMany(CityEloquent::class, 'city_province_id', 'province_id');
    }
}
