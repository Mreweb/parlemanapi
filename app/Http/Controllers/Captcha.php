<?php

namespace App\Http\Controllers;
use App\Domain\Interfaces\ICaptchaRepository;
use App\Http\Requests\CaptchaVerifyRequest;


class Captcha{

    protected $captcha;
    public function __construct(ICaptchaRepository $captcha){
        $this->captcha = $captcha;
    }
    /**
     * @lrd:start
     * تولید کپچا
     * @lrd:end
     */
    public function generate()
    {
        return $this->captcha->generate();
    }
    /**
     * @lrd:start
     * احراز کپچا
     * @lrd:end
     */
    public function verify(CaptchaVerifyRequest $request){
        return $this->captcha->verify($request);
    }

}
