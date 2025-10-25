<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Trip\ITripRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Trip\TripRepository;
use Illuminate\Support\ServiceProvider;
class ITripRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(ITripRepository::class, TripRepository::class);
    }
    public function boot(): void{ }
}
