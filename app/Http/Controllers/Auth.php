<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Domain\Interfaces\IAuthRepository;
use App\Http\Requests\Auth\UsernameRequest;


class Auth{

    protected $service;
    public function __construct(IAuthRepository $repository){
        $this->service = $repository;
    }

    public function otp()
    {
        /*$result = $this->service->otp($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }*/
    }
    public function verifyOtp()
    {
        /*$result = $this->service->verifyOtp($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }*/
    }
    /**
     * @lrd:start
     * ورود با نام کاربری و رمز عبور
     * @lrd:end
     */
    public function loginByUsername(UsernameRequest $request){
        return $this->service->loginByUsername($request->validated());
    }



}
