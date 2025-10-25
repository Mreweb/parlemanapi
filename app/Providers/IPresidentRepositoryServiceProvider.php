<?php
namespace App\Providers;
use App\Domain\Interfaces\Common\President\IPresidentRepository;
use App\Infrastructure\Persistence\Repositories\Common\President\PresidentRepository;
use Illuminate\Support\ServiceProvider;
class IPresidentRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IPresidentRepository::class, PresidentRepository::class);
    }
    public function boot(): void{ }
}
