<?php

namespace App\Application\Services\Auth;
use App\Domain\Interfaces\Auth\IAuthRepository;

class AuthService{

    public function __construct(private IAuthRepository $repository){}
    public function otp(array $data){
    }
    public function verifyOtp(array $data)
    {
    }
    public function loginByUsername(array $data)
    {
        return $this->repository->loginByUsername($data);
    }
}
