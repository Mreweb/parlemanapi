<?php
namespace App\Providers;
use App\Domain\Interfaces\Common\Election\IElectionLocationRepository;
use App\Infrastructure\Persistence\Repositories\Common\Election\ElectionLocationRepository;
use Illuminate\Support\ServiceProvider;
class IElectionLocationRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IElectionLocationRepository::class, ElectionLocationRepository::class);
    }
    public function boot(): void{ }
}
