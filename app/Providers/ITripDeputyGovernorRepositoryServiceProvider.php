<?php
namespace App\Providers;
use App\Domain\Interfaces\BossErea\TripDeputy\ITripDeputyGovernorRepository;
use App\Infrastructure\Persistence\Repositories\BossErea\TripDeputyGovernor\TripDeputyGovernorRepository;
use Illuminate\Support\ServiceProvider;
class ITripDeputyGovernorRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(ITripDeputyGovernorRepository::class, TripDeputyGovernorRepository::class);
    }
    public function boot(): void{ }
}
