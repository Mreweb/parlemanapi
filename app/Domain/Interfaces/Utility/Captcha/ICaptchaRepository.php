<?php

namespace App\Domain\Interfaces\Utility\Captcha;
use App\Http\Requests\Utility\Captcha\CaptchaVerifyRequest;

interface ICaptchaRepository {
    public function generate();
    public function verify(CaptchaVerifyRequest $userInput);
}


?>
