<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ElectionLocationController;
use App\Http\Controllers\ParlemanPeriodController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PresidentController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\Captcha;
 use Illuminate\Support\Facades\Route;


Route::get('/captcha', [Captcha::class, 'generate']);
Route::post('/captcha/verify', [Captcha::class, 'verify']);


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


Route::prefix('parleman_period')->group(function () {
    Route::get('/', [ParlemanPeriodController::class, 'index']);
    Route::get('/{id}', [ParlemanPeriodController::class, 'show']);
    Route::post('/', [ParlemanPeriodController::class, 'store']);
    Route::put('/', [ParlemanPeriodController::class, 'update']);
    Route::delete('/{id}', [ParlemanPeriodController::class, 'destroy']);
});



Route::prefix('election_location')->group(function () {
    Route::get('/', [ElectionLocationController::class, 'index']);
    Route::get('/{id}', [ElectionLocationController::class, 'show']);
    Route::post('/', [ElectionLocationController::class, 'store']);
    Route::put('/', [ElectionLocationController::class, 'update']);
    Route::delete('/{id}', [ElectionLocationController::class, 'destroy']);
});
