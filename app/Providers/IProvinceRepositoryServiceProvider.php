<?php
namespace App\Providers;
use App\Domain\Interfaces\Common\Country\IProvinceRepository;
use App\Infrastructure\Persistence\Repositories\Common\Country\ProvinceRepository;
use Illuminate\Support\ServiceProvider;
class IProvinceRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IProvinceRepository::class, ProvinceRepository::class);
    }
    public function boot(): void{ }
}
