<?php

namespace App\Domain\Interfaces;
use App\Http\Requests\CaptchaVerifyRequest;

interface ICaptchaService {
    public function generate();
    public function verify(CaptchaVerifyRequest $userInput);
}


?>
