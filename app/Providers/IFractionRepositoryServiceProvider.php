<?php
namespace App\Providers;
use App\Domain\Interfaces\Common\Fraction\IFractionRepository;
use App\Infrastructure\Persistence\Repositories\Common\Fraction\FractionRepository;
use Illuminate\Support\ServiceProvider;
class IFractionRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IFractionRepository::class, FractionRepository::class);
    }
    public function boot(): void{ }
}
