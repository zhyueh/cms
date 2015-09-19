<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('reg', function($attribute, $value, $parameters) {
            return User::count() < 2;
        });
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
