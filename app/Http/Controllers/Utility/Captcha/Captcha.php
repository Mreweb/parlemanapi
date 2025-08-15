<?php

namespace App\Http\Controllers\Utility\Captcha;
use App\Application\Services\Utility\Captcha\CaptchaService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Utility\Captcha\CaptchaVerifyRequest;


class Captcha  extends Controller{

    protected $captcha;
    public function __construct(CaptchaService $captcha){
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
