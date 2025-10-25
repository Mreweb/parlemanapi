<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Requests\IRequestsRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\PRequest\PersonRequestsRepository;
use Illuminate\Support\ServiceProvider;
class IRequestsRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IRequestsRepository::class, PersonRequestsRepository::class);
    }
    public function boot(): void{ }
}
