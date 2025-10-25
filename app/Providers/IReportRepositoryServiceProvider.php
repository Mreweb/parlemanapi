<?php
namespace App\Providers;
use App\Domain\Interfaces\Utility\Report\IReportRepository;
use App\Infrastructure\Persistence\Repositories\Utility\Report\Report\ReportRepository;
use Illuminate\Support\ServiceProvider;
class IReportRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IReportRepository::class, ReportRepository::class);
    }
    public function boot(): void{ }
}
