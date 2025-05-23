<?php

namespace App\Domain\Interfaces;

interface IDBMessage{
    static function get_message($items = null,$type="SuccessAction" , $content="");
}
