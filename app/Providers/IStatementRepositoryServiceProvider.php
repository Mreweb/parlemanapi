<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Statement\IStatementRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Statement\StatementRepository;
use Illuminate\Support\ServiceProvider;
class IStatementRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IStatementRepository::class, StatementRepository::class);
    }
    public function boot(): void{ }
}
