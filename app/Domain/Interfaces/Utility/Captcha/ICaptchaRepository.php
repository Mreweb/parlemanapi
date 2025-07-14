<?php

namespace App\Domain\Interfaces;
use App\Http\Requests\CaptchaVerifyRequest;

interface ICaptchaRepository {
    public function generate();
    public function verify(CaptchaVerifyRequest $userInput);
}


?>
