<?php
namespace App\Providers;
use App\Domain\Interfaces\BossErea\SessionDeputy\ISessionDeputyGovernorRepository;
use App\Infrastructure\Persistence\Repositories\BossErea\SessionDeputyGovernor\SessionDeputyGovernorRepository;
use Illuminate\Support\ServiceProvider;
class ISessionDeputyGovernorRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(ISessionDeputyGovernorRepository::class, SessionDeputyGovernorRepository::class);
    }
    public function boot(): void{ }
}
