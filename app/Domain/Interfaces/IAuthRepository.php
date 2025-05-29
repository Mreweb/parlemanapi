<?php

namespace App\Domain\Interfaces;

interface IAuthRepository {

    public function otp();
    public function verifyOtp();
    public function loginByUsername(array $data);

}


?>
