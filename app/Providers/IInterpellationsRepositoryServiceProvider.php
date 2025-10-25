<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Interpellation\IInterpellationsRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Interpellation\InterpellationRepository;
use Illuminate\Support\ServiceProvider;
class IInterpellationsRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IInterpellationsRepository::class, InterpellationRepository::class);
    }
    public function boot(): void{ }
}
