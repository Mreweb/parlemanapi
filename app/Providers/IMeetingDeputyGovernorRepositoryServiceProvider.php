<?php
namespace App\Providers;
use App\Domain\Interfaces\BossErea\MeetingDeputy\IMeetingDeputyGovernorRepository;
use App\Infrastructure\Persistence\Repositories\BossErea\MeetingDeputyGovernor\MeetingDeputyGovernorRepository;
use Illuminate\Support\ServiceProvider;
class IMeetingDeputyGovernorRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IMeetingDeputyGovernorRepository::class, MeetingDeputyGovernorRepository::class);
    }
    public function boot(): void{ }
}
