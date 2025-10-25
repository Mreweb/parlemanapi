<?php

namespace App\Providers;
use App\Application\Services\Utility\Captcha\CaptchaService;
use App\Application\Services\Utility\DBMessageService;
use App\Domain\Interfaces\Utility\Captcha\ICaptchaRepository;
use App\Domain\Interfaces\Utility\IDBMessage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider{

    public function register(): void{
        $this->app->singleton(ICaptchaRepository::class, CaptchaService::class);
        $this->app->singleton(IDBMessage::class, DBMessageService::class);
    }
    public function boot(): void{
        Schema::defaultStringLength(250);
    }
}
