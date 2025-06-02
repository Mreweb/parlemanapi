<?php

namespace App\Providers;

use App\Application\Services\CaptchaService;
use App\Application\Services\DBMessageService;
use App\Domain\Interfaces\IAuthRepository;
use App\Domain\Interfaces\ICaptchaRepository;
use App\Domain\Interfaces\ICityRepository;
use App\Domain\Interfaces\ICommissionRepository;
use App\Domain\Interfaces\IDBMessage;
use App\Domain\Interfaces\IElectionLocationRepository;
use App\Domain\Interfaces\IMinistryRepository;
use App\Domain\Interfaces\IParlemanPeriodRepository;
use App\Domain\Interfaces\IPersonRepository;
use App\Domain\Interfaces\IPresidentRepository;
use App\Domain\Interfaces\IProvinceRepository;
use App\Infrastructure\Persistence\Repositories\AuthRepository;
use App\Infrastructure\Persistence\Repositories\CityRepository;
use App\Infrastructure\Persistence\Repositories\CommissionRepository;
use App\Infrastructure\Persistence\Repositories\ElectionLocationRepository;
use App\Infrastructure\Persistence\Repositories\MinistryRepository;
use App\Infrastructure\Persistence\Repositories\ParlemanPeriodRepository;
use App\Infrastructure\Persistence\Repositories\PersonRepository;
use App\Infrastructure\Persistence\Repositories\PresidentRepository;
use App\Infrastructure\Persistence\Repositories\ProvinceRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider{

    public function register(): void{
        $this->app->singleton(ICaptchaRepository::class, CaptchaService::class);
        $this->app->singleton(IDBMessage::class, DBMessageService::class);
        $this->app->singleton(IProvinceRepository::class, ProvinceRepository::class);
        $this->app->singleton(ICityRepository::class, CityRepository::class);
        $this->app->singleton(IPersonRepository::class, PersonRepository::class);
        $this->app->singleton(IPresidentRepository::class, PresidentRepository::class);
        $this->app->singleton(IParlemanPeriodRepository::class, ParlemanPeriodRepository::class);
        $this->app->singleton(IElectionLocationRepository::class, ElectionLocationRepository::class);
        $this->app->singleton(IAuthRepository::class, AuthRepository::class);
        $this->app->singleton(ICommissionRepository::class, CommissionRepository::class);
        $this->app->singleton(IMinistryRepository::class, MinistryRepository::class);
    }
    public function boot(): void{
        Schema::defaultStringLength(220);
    }
}
