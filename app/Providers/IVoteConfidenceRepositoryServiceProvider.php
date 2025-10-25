<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\VoteConfident\IVoteConfidenceRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\VoteConfidence\VoteConfidenceRepository;
use Illuminate\Support\ServiceProvider;
class IVoteConfidenceRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IVoteConfidenceRepository::class, VoteConfidenceRepository::class);
    }
    public function boot(): void{ }
}
