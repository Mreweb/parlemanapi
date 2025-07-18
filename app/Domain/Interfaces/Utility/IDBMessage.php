<?php

namespace App\Domain\Interfaces\Utility;

interface IDBMessage{
    static function get_message($items = null,$type="SuccessAction" , $content="");
}
