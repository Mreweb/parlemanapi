<?php

namespace App\Providers;

use App\Domain\Interfaces\Common\GovPeriod\IGovPeriodRepository;
use App\Infrastructure\Persistence\Repositories\Common\GovPeriod\GovPeriodRepository;
use Illuminate\Support\ServiceProvider;

class IGovPeriodRepositoryServiceProvider extends ServiceProvider{

    public function register(): void{
        $this->app->singleton(IGovPeriodRepository::class, GovPeriodRepository::class);
    }
    public function boot(): void{

    }
}
