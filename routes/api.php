<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ElectionLocationController;
use App\Http\Controllers\Enums;
use App\Http\Controllers\FractionController;
use App\Http\Controllers\GovPeriodController;
use App\Http\Controllers\InterpellationController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ParlemanPeriodController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonMeetingController;
use App\Http\Controllers\PresidentCabinetController;
use App\Http\Controllers\PresidentController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\Captcha;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\Upload;
use App\Http\Controllers\VoteConfidenceController;
use Illuminate\Support\Facades\Route;


Route::get('/enum', [Enums::class, 'index']);
Route::post('/file', [Upload::class, 'save']);
Route::get('/file/{id}', [Upload::class, 'get_file']);

Route::get('/captcha', [Captcha::class, 'generate']);
Route::post('/captcha/verify', [Captcha::class, 'verify']);

Route::prefix('auth')->group( function () {
    Route::post('/username', [Auth::class, 'loginByUsername']);
});


Route::prefix('provinces')->group(function () {
    Route::get('/', [ProvinceController::class, 'index']);
    Route::get('/{id}', [ProvinceController::class, 'show']);
    Route::get('/cities/{id}', [ProvinceController::class, 'cities']);
    Route::post('/', [ProvinceController::class, 'store']);
    Route::put('/', [ProvinceController::class, 'update']);
    Route::delete('/{id}', [ProvinceController::class, 'destroy']);
});


Route::prefix('city')->group(function () {
    Route::get('/', [CityController::class, 'index']);
    Route::get('/{id}', [CityController::class, 'show']);
    Route::post('/', [CityController::class, 'store']);
    Route::put('/', [CityController::class, 'update']);
    Route::delete('/{id}', [CityController::class, 'destroy']);
});

Route::prefix('person')->group(function () {
    Route::get('/', [PersonController::class, 'index']);
    Route::get('/{id}', [PersonController::class, 'show']);
    Route::post('/', [PersonController::class, 'store']);
    Route::post('/update_fraction', [PersonController::class, 'update_fraction']);
    Route::post('/update_election', [PersonController::class, 'update_election']);
    Route::post('/update_commission', [PersonController::class, 'update_commission']);
    Route::put('/', [PersonController::class, 'update']);
    Route::delete('/{id}', [PersonController::class, 'destroy']);
});

Route::prefix('president')->group(function () {
    Route::get('/', [PresidentController::class, 'index']);
    Route::get('/{id}', [PresidentController::class, 'show']);
    Route::post('/', [PresidentController::class, 'store']);
    Route::put('/', [PresidentController::class, 'update']);
    Route::delete('/{id}', [PresidentController::class, 'destroy']);
});

Route::prefix('president_cabinet')->group(function () {
    Route::get('/', [PresidentCabinetController::class, 'index']);
    Route::get('/{id}', [PresidentCabinetController::class, 'show']);
    Route::post('/', [PresidentCabinetController::class, 'store']);
    Route::put('/', [PresidentCabinetController::class, 'update']);
    Route::delete('/{id}', [PresidentCabinetController::class, 'destroy']);
});


Route::prefix('parleman_period')->group(function () {
    Route::get('/', [ParlemanPeriodController::class, 'index']);
    Route::get('/{id}', [ParlemanPeriodController::class, 'show']);
    Route::post('/', [ParlemanPeriodController::class, 'store']);
    Route::put('/', [ParlemanPeriodController::class, 'update']);
    Route::delete('/{id}', [ParlemanPeriodController::class, 'destroy']);
});

Route::prefix('gov_period')->group(function () {
    Route::get('/', [GovPeriodController::class, 'index']);
    Route::get('/{id}', [GovPeriodController::class, 'show']);
    Route::post('/', [GovPeriodController::class, 'store']);
    Route::put('/', [GovPeriodController::class, 'update']);
    Route::delete('/{id}', [GovPeriodController::class, 'destroy']);
});


Route::prefix('election_location')->group(function () {
    Route::get('/', [ElectionLocationController::class, 'index']);
    Route::get('/{id}', [ElectionLocationController::class, 'show']);
    Route::post('/', [ElectionLocationController::class, 'store']);
    Route::put('/', [ElectionLocationController::class, 'update']);
    Route::delete('/{id}', [ElectionLocationController::class, 'destroy']);
});


Route::prefix('commission')->group(function () {
    Route::get('/', [CommissionController::class, 'index']);
    Route::get('/{id}', [CommissionController::class, 'show']);
    Route::post('/', [CommissionController::class, 'store']);
    Route::put('/', [CommissionController::class, 'update']);
    Route::delete('/{id}', [CommissionController::class, 'destroy']);
});


Route::prefix('fraction')->group(function () {
    Route::get('/', [FractionController::class, 'index']);
    Route::get('/{id}', [FractionController::class, 'show']);
    Route::post('/', [FractionController::class, 'store']);
    Route::put('/', [FractionController::class, 'update']);
    Route::delete('/{id}', [FractionController::class, 'destroy']);
});


Route::prefix('ministry')->group(function () {
    Route::get('/', [MinistryController::class, 'index']);
    Route::get('/{id}', [MinistryController::class, 'show']);
    Route::post('/', [MinistryController::class, 'store']);
    Route::put('/', [MinistryController::class, 'update']);
    Route::delete('/{id}', [MinistryController::class, 'destroy']);
});


Route::prefix('notice')->group(function () {
    Route::get('/', [NoticeController::class, 'index']);
    Route::get('/{id}', [NoticeController::class, 'show']);
    Route::post('/', [NoticeController::class, 'store']);
    Route::put('/', [NoticeController::class, 'update']);
    Route::delete('/{id}', [NoticeController::class, 'destroy']);
});

Route::prefix('question')->group(function () {
    Route::get('/', [QuestionController::class, 'index']);
    Route::get('/{id}', [QuestionController::class, 'show']);
    Route::post('/', [QuestionController::class, 'store']);
    Route::put('/', [QuestionController::class, 'update']);
    Route::delete('/{id}', [QuestionController::class, 'destroy']);
});

Route::prefix('interpellation')->group(function () {
    Route::get('/', [InterpellationController::class, 'index']);
    Route::get('/{id}', [InterpellationController::class, 'show']);
    Route::post('/', [InterpellationController::class, 'store']);
    Route::put('/', [InterpellationController::class, 'update']);
    Route::delete('/{id}', [InterpellationController::class, 'destroy']);
});

Route::prefix('meeting')->group(function () {
    Route::get('/', [PersonMeetingController::class, 'index']);
    Route::get('/{id}', [PersonMeetingController::class, 'show']);
    Route::post('/', [PersonMeetingController::class, 'store']);
    Route::post('/add_meeting_track', [PersonMeetingController::class, 'add_meeting_track']);
    Route::put('/update_meeting_track', [PersonMeetingController::class, 'update_meeting_track']);
    Route::put('/', [PersonMeetingController::class, 'update']);
    Route::delete('/{id}', [PersonMeetingController::class, 'destroy']);
});

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectsController::class, 'index']);
    Route::get('/{id}', [ProjectsController::class, 'show']);
    Route::post('/', [ProjectsController::class, 'store']);
    Route::put('/', [ProjectsController::class, 'update']);
    Route::delete('/{id}', [ProjectsController::class, 'destroy']);
});

Route::prefix('requests')->group(function () {
    Route::get('/', [RequestsController::class, 'index']);
    Route::get('/{id}', [RequestsController::class, 'show']);
    Route::post('/', [RequestsController::class, 'store']);
    Route::put('/', [RequestsController::class, 'update']);
    Route::delete('/{id}', [RequestsController::class, 'destroy']);

    Route::post('/add_track', [RequestsController::class, 'add_track']);
    Route::put('/update_track', [RequestsController::class, 'update_track']);
    Route::delete('/delete_track/{id}', [RequestsController::class, 'delete_track']);

});
Route::prefix('rules')->group(function () {
    Route::get('/', [RulesController::class, 'index']);
    Route::get('/{id}', [RulesController::class, 'show']);
    Route::post('/', [RulesController::class, 'store']);
    Route::put('/', [RulesController::class, 'update']);
    Route::delete('/{id}', [RulesController::class, 'destroy']);
});

Route::prefix('vote_confidence')->group(function () {
    Route::get('/', [VoteConfidenceController::class, 'index']);
    Route::get('/{id}', [VoteConfidenceController::class, 'show']);
    Route::post('/', [VoteConfidenceController::class, 'store']);
    Route::put('/', [VoteConfidenceController::class, 'update']);
    Route::delete('/{id}', [VoteConfidenceController::class, 'destroy']);
});
