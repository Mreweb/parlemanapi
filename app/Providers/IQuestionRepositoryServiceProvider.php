<?php
namespace App\Providers;
use App\Domain\Interfaces\PersonArea\Question\IQuestionRepository;
use App\Infrastructure\Persistence\Repositories\PersonArea\Question\QuestionRepository;
use Illuminate\Support\ServiceProvider;
class IQuestionRepositoryServiceProvider extends ServiceProvider{
    public function register(): void{
        $this->app->singleton(IQuestionRepository::class, QuestionRepository::class);
    }
    public function boot(): void{ }
}
