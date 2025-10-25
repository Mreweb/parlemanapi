<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Person\IPersonRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Person\PersonRepository;
use Illuminate\Support\ServiceProvider;
class IPersonRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IPersonRepository::class, PersonRepository::class);
    }
    public function boot(): void{ }
}
