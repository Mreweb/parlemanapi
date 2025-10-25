<?php
namespace App\Providers;
use App\Domain\Interfaces\Utility\Media\IUploadRepository;
use App\Infrastructure\Persistence\Repositories\Utility\Media\File\UploadRepository;
use Illuminate\Support\ServiceProvider;
class IUploadRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IUploadRepository::class, UploadRepository::class);
    }
    public function boot(): void{ }
}
