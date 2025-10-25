<?php
namespace App\Providers;
use App\Domain\Interfaces\BossErea\MediaDeputy\IMediaDeputyGovernorRepository;
use App\Infrastructure\Persistence\Repositories\BossErea\MediaDeputyGovernor\MediaDeputyGovernorRepository;
use Illuminate\Support\ServiceProvider;
class IMediaDeputyGovernorRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IMediaDeputyGovernorRepository::class, MediaDeputyGovernorRepository::class);
    }
    public function boot(): void{ }
}
