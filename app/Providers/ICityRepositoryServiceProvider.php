<?php

namespace App\Providers;
use App\Domain\Interfaces\Common\Country\ICityRepository;
use App\Infrastructure\Persistence\Repositories\Common\Country\CityRepository;
use Illuminate\Support\ServiceProvider;

class ICityRepositoryServiceProvider extends ServiceProvider{

    public function register(): void{
        $this->app->singleton(ICityRepository::class, CityRepository::class);
    }
    public function boot(): void{

    }
}
