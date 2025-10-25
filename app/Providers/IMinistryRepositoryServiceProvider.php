<?php
namespace App\Providers;
use App\Domain\Interfaces\Common\Ministry\IMinistryRepository;
use App\Infrastructure\Persistence\Repositories\Common\Ministry\MinistryRepository;
use Illuminate\Support\ServiceProvider;
class IMinistryRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IMinistryRepository::class, MinistryRepository::class);
    }
    public function boot(): void{ }
}
