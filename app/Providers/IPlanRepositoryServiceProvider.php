<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Plan\IPlanRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Plan\PlanRepository;
use Illuminate\Support\ServiceProvider;
class IPlanRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IPlanRepository::class, PlanRepository::class);
    }
    public function boot(): void{ }
}
