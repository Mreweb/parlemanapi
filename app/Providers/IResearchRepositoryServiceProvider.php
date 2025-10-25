<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\PersonResearch\IResearchRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Research\ResearchRepository;
use Illuminate\Support\ServiceProvider;
class IResearchRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IResearchRepository::class, ResearchRepository::class);
    }
    public function boot(): void{ }
}
