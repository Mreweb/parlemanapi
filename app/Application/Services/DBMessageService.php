<?php

namespace App\Application\Services;


use App\Domain\Interfaces\IDBMessage;
class DBMessageService implements IDBMessage {
    public static function get_message($items = null, $type = "SuccessAction", $content = ""){

        $DBMessages = [
            'SuccessAction' => [
                'class' => "green",
                'type' => "Service.Success",
                'content' => "عملیات با موفقیت انجام شد",
                'success' => true
            ],
            'ErrorAction' => [
                'class' => "red",
                'type' => "Service.Error",
                'content' => "عملیات با خطا مواجه شد",
                'success' => false
            ],
            'RequiredFields' => [
                'class' => "red",
                'type' => "Service.RequiredFields",
                'content' => 'تمامی مقادیر الزامی را وارد کنید',
                'success' => false
            ],
            'DuplicateInfo' => [
                'class' => "yellow",
                'type' => "Service.Duplicate",
                'content' => 'اطلاعات قبلا در سامانه ثبت شده است',
                'success' => false
            ]
        ];
        $msg = $DBMessages[$type];
        if($content != ""){
            $msg['content'] = $content;
        }
        if($items != null){
            $msg['items'] = $items;
        }
        if($items == []){
            $msg['items'] = [];
        }
        return $msg;
    }
}
