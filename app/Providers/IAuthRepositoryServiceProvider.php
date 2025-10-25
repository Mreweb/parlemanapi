<?php

namespace App\Providers;

use App\Domain\Interfaces\Auth\IAuthRepository;
use App\Infrastructure\Persistence\Repositories\Auth\AuthRepository;
use Illuminate\Support\ServiceProvider;

class IAuthRepositoryServiceProvider extends ServiceProvider{

    public function register(): void{
        $this->app->singleton(IAuthRepository::class, AuthRepository::class);
    }
    public function boot(): void{

    }
}
