<?php
namespace App\Providers;
use App\Domain\Interfaces\Common\PerlemanPeriod\IParlemanPeriodRepository;
use App\Infrastructure\Persistence\Repositories\Common\ParlemanPeriod\ParlemanPeriodRepository;
use Illuminate\Support\ServiceProvider;
class IParlemanPeriodRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IParlemanPeriodRepository::class, ParlemanPeriodRepository::class);
    }
    public function boot(): void{ }
}
