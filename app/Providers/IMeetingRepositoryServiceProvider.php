<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Meeting\IMeetingRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Meeting\MeetingRepository;
use Illuminate\Support\ServiceProvider;
class IMeetingRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IMeetingRepository::class, MeetingRepository::class);
    }
    public function boot(): void{ }
}
