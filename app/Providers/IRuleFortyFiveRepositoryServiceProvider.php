<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\RuleFortyFive\IRuleFortyFiveRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\RuleFortyFive\RuleFortyFiveRepository;
use Illuminate\Support\ServiceProvider;
class IRuleFortyFiveRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IRuleFortyFiveRepository::class, RuleFortyFiveRepository::class);
    }
    public function boot(): void{ }
}
