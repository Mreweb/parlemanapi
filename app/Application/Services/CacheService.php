<?php

namespace App\Application\Services;

use App\Domain\Interfaces\ICache;
use Illuminate\Support\Facades\Cache;

class CacheService implements ICache {

    static function get_data($key) {
        return Cache::get($key);
    }
    static function has_data($key): bool{
        return Cache::has($key);
    }
    static function set_data($key,$data){
        return Cache::set($key,$data,1000000);
    }
    static function forget_data($key){
        return Cache::forget($key);
    }
}
