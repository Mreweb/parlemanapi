<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Projects\IProjectsRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Projects\ProjectsRepository;
use Illuminate\Support\ServiceProvider;
class IProjectsRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IProjectsRepository::class, ProjectsRepository::class);
    }
    public function boot(): void{ }
}
