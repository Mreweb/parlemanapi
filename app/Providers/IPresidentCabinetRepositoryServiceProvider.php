<?php
namespace App\Providers;
use App\Domain\Interfaces\Common\PresidentCabinet\IPresidentCabinetRepository;
use App\Infrastructure\Persistence\Repositories\Common\PresidentCabinet\PresidentCabinetRepository;
use Illuminate\Support\ServiceProvider;
class IPresidentCabinetRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IPresidentCabinetRepository::class, PresidentCabinetRepository::class);
    }
    public function boot(): void{ }
}
