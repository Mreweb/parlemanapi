<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Speech\ISpeechRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Speech\SpeechRepository;
use Illuminate\Support\ServiceProvider;
class ISpeechRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(ISpeechRepository::class, SpeechRepository::class);
    }
    public function boot(): void{ }
}
