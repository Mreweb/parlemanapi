<?php

namespace App\Providers;

use App\Application\Services\CaptchaService;
use App\Application\Services\DBMessageService;
use App\Domain\Interfaces\IAuthRepository;
use App\Domain\Interfaces\ICaptchaRepository;
use App\Domain\Interfaces\ICityRepository;
use App\Domain\Interfaces\ICommissionRepository;
use App\Domain\Interfaces\IDBMessage;
use App\Domain\Interfaces\IElectionLocationRepository;
use App\Domain\Interfaces\IFractionRepository;
use App\Domain\Interfaces\IGovPeriodRepository;
use App\Domain\Interfaces\IInterpellationsRepository;
use App\Domain\Interfaces\IMeetingRepository;
use App\Domain\Interfaces\IMinistryRepository;
use App\Domain\Interfaces\INoticeRepository;
use App\Domain\Interfaces\IParlemanPeriodRepository;
use App\Domain\Interfaces\IPersonRepository;
use App\Domain\Interfaces\IPresidentRepository;
use App\Domain\Interfaces\IProjectsRepository;
use App\Domain\Interfaces\IProvinceRepository;
use App\Domain\Interfaces\IQuestionRepository;
use App\Domain\Interfaces\IRequestsRepository;
use App\Domain\Interfaces\IUploadRepository;
use App\Infrastructure\Persistence\Repositories\AuthRepository;
use App\Infrastructure\Persistence\Repositories\CityRepository;
use App\Infrastructure\Persistence\Repositories\CommissionRepository;
use App\Infrastructure\Persistence\Repositories\ElectionLocationRepository;
use App\Infrastructure\Persistence\Repositories\FractionRepository;
use App\Infrastructure\Persistence\Repositories\GovPeriodRepository;
use App\Infrastructure\Persistence\Repositories\InterpellationRepository;
use App\Infrastructure\Persistence\Repositories\MeetingRepository;
use App\Infrastructure\Persistence\Repositories\MinistryRepository;
use App\Infrastructure\Persistence\Repositories\NoticeRepository;
use App\Infrastructure\Persistence\Repositories\ParlemanPeriodRepository;
use App\Infrastructure\Persistence\Repositories\PersonRepository;
use App\Infrastructure\Persistence\Repositories\PersonRequestsRepository;
use App\Infrastructure\Persistence\Repositories\PresidentRepository;
use App\Infrastructure\Persistence\Repositories\ProjectsRepository;
use App\Infrastructure\Persistence\Repositories\ProvinceRepository;
use App\Infrastructure\Persistence\Repositories\QuestionRepository;
use App\Infrastructure\Persistence\Repositories\UploadRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider{

    public function register(): void{
        $this->app->singleton(IAuthRepository::class, AuthRepository::class);
        $this->app->singleton(ICaptchaRepository::class, CaptchaService::class);
        $this->app->singleton(IDBMessage::class, DBMessageService::class);
        $this->app->singleton(ICityRepository::class, CityRepository::class);
        $this->app->singleton(ICommissionRepository::class, CommissionRepository::class);
        $this->app->singleton(IElectionLocationRepository::class, ElectionLocationRepository::class);
        $this->app->singleton(IFractionRepository::class, FractionRepository::class);
        $this->app->singleton(IGovPeriodRepository::class, GovPeriodRepository::class);
        $this->app->singleton(IInterpellationsRepository::class, InterpellationRepository::class);
        $this->app->singleton(IMeetingRepository::class, MeetingRepository::class);
        $this->app->singleton(IMinistryRepository::class, MinistryRepository::class);
        $this->app->singleton(INoticeRepository::class, NoticeRepository::class);
        $this->app->singleton(IParlemanPeriodRepository::class, ParlemanPeriodRepository::class);
        $this->app->singleton(IPersonRepository::class, PersonRepository::class);
        $this->app->singleton(IPresidentRepository::class, PresidentRepository::class);
        $this->app->singleton(IProvinceRepository::class, ProvinceRepository::class);
        $this->app->singleton(IQuestionRepository::class, QuestionRepository::class);
        $this->app->singleton(IUploadRepository::class, UploadRepository::class);
        $this->app->singleton(IProjectsRepository::class, ProjectsRepository::class);
        $this->app->singleton(IRequestsRepository::class, PersonRequestsRepository::class);
    }
    public function boot(): void{
        Schema::defaultStringLength(250);
    }
}
