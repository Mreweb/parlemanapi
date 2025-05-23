<?php

namespace App\Providers;

use App\Application\Services\CaptchaService;
use App\Application\Services\DBMessageService;
use App\Domain\Interfaces\ICaptchaService;
use App\Domain\Interfaces\ICityRepository;
use App\Domain\Interfaces\IDBMessage;
use App\Domain\Interfaces\IElectionLocation;
use App\Domain\Interfaces\IParlemanPeriod;
use App\Domain\Interfaces\IPersonRepository;
use App\Domain\Interfaces\IPresident;
use App\Domain\Interfaces\IProvinceRepository;
use App\Infrastructure\Persistence\Repositories\CityRepository;
use App\Infrastructure\Persistence\Repositories\ElectionLocationRepository;
use App\Infrastructure\Persistence\Repositories\ParlemanPeriodRepository;
use App\Infrastructure\Persistence\Repositories\PersonRepository;
use App\Infrastructure\Persistence\Repositories\PresidentRepository;
use App\Infrastructure\Persistence\Repositories\ProvinceRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(ICaptchaService::class, CaptchaService::class);
        $this->app->singleton(IDBMessage::class, DBMessageService::class);
        $this->app->singleton(IProvinceRepository::class, ProvinceRepository::class);
        $this->app->singleton(ICityRepository::class, CityRepository::class);
        $this->app->singleton(IPersonRepository::class, PersonRepository::class);
        $this->app->singleton(IPresident::class, PresidentRepository::class);
        $this->app->singleton(IParlemanPeriod::class, ParlemanPeriodRepository::class);
        $this->app->singleton(IElectionLocation::class, ElectionLocationRepository::class);
    }

    public function boot(): void
    {
        Schema::defaultStringLength(220);
    }
}
