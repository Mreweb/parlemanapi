<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\RuleTTF\IRuleTTFRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\RuleTTF\RuleTTFRepository;
use Illuminate\Support\ServiceProvider;
class IRuleTTFRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IRuleTTFRepository::class, RuleTTFRepository::class);
    }
    public function boot(): void{ }
}
