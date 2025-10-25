<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Rules\IRulesRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Rules\PersonRulesRepository;
use Illuminate\Support\ServiceProvider;
class IRulesRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IRulesRepository::class, PersonRulesRepository::class);
    }
    public function boot(): void{ }
}
