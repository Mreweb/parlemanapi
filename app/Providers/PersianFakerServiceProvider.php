<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Factory as Faker;
use Faker\Provider\Base;

class PersianFakerServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the custom Persian faker provider
        $this->app->singleton(Faker::class, function ($app) {
            $faker = Faker::create('fa_IR'); // Use Persian locale

            // Add custom methods here
            $faker->addProvider(new PersianFakerProvider($faker));
            return $faker;
        });
    }

    public function boot()
    {
        //
    }
}
