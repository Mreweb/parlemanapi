<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Notice\INoticeRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Notice\NoticeRepository;
use Illuminate\Support\ServiceProvider;
class INoticeRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(INoticeRepository::class, NoticeRepository::class);
    }
    public function boot(): void{ }
}
