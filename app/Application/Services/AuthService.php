<?php

namespace App\Application\Services;
use App\Infrastructure\Persistence\Repositories\AuthRepository;

class AuthService{

    public function __construct(private AuthRepository $repository){}


    public function otp(array $data){
        //return $this->repository->otp($data);
    }
    public function verifyOtp(array $data)
    {
       //return $this->repository->verifyOtp($data);
    }
    public function loginByUsername(array $data)
    {
        return $this->repository->loginByUsername($data);
    }
}
