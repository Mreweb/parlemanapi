<?php

namespace App\Providers;
use App\Domain\Interfaces\Common\Commission\ICommissionRepository;
use App\Infrastructure\Persistence\Repositories\Common\Commission\CommissionRepository;
use Illuminate\Support\ServiceProvider;

class ICommissionRepositoryServiceProvider extends ServiceProvider{

    public function register(): void{
        $this->app->singleton(ICommissionRepository::class, CommissionRepository::class);
    }
    public function boot(): void{

    }
}
