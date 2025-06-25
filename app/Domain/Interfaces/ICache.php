<?php

namespace App\Domain\Interfaces;

interface ICache{
    static function get_data($key);
    static function has_data($key);
    static function set_data($key,$data);
    static function forget_data($key);
}
