<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Enactment\IEnactmentRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Enactment\EnactmentRepository;
use Illuminate\Support\ServiceProvider;
class IEnactmentRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IEnactmentRepository::class, EnactmentRepository::class);
    }
    public function boot(): void{ }
}
