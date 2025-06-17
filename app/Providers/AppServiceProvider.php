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
use App\Domain\Interfaces\IRulesRepository;
use App\Domain\Interfaces\IRuleTTFRepository;
use App\Domain\Interfaces\IUploadRepository;
use App\Domain\Interfaces\IVoteConfidenceRepository;
use App\Infrastructure\Persistence\Repositories\Auth\AuthRepository;
use App\Infrastructure\Persistence\Repositories\Commission\CommissionRepository;
use App\Infrastructure\Persistence\Repositories\Country\CityRepository;
use App\Infrastructure\Persistence\Repositories\Country\ProvinceRepository;
use App\Infrastructure\Persistence\Repositories\Election\ElectionLocationRepository;
use App\Infrastructure\Persistence\Repositories\File\UploadRepository;
use App\Infrastructure\Persistence\Repositories\Fraction\FractionRepository;
use App\Infrastructure\Persistence\Repositories\GovPeriod\GovPeriodRepository;
use App\Infrastructure\Persistence\Repositories\Interpellation\InterpellationRepository;
use App\Infrastructure\Persistence\Repositories\Meeting\MeetingRepository;
use App\Infrastructure\Persistence\Repositories\Ministry\MinistryRepository;
use App\Infrastructure\Persistence\Repositories\Notice\NoticeRepository;
use App\Infrastructure\Persistence\Repositories\ParlemanPeriod\ParlemanPeriodRepository;
use App\Infrastructure\Persistence\Repositories\Person\PersonRepository;
use App\Infrastructure\Persistence\Repositories\PRequest\PersonRequestsRepository;
use App\Infrastructure\Persistence\Repositories\President\PresidentRepository;
use App\Infrastructure\Persistence\Repositories\Projects\ProjectsRepository;
use App\Infrastructure\Persistence\Repositories\Question\QuestionRepository;
use App\Infrastructure\Persistence\Repositories\Rules\PersonRulesRepository;
use App\Infrastructure\Persistence\Repositories\RuleTTF\RuleTTFRepository;
use App\Infrastructure\Persistence\Repositories\VoteConfidence\VoteConfidenceRepository;
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
        $this->app->singleton(IRulesRepository::class, PersonRulesRepository::class);
        $this->app->singleton(IVoteConfidenceRepository::class, VoteConfidenceRepository::class);
        $this->app->singleton(IRuleTTFRepository::class, RuleTTFRepository::class);
    }
    public function boot(): void{
        Schema::defaultStringLength(250);
    }
}
