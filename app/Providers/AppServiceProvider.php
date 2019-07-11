<?php

namespace App\Providers;

use App\Users\Models\User as User;
use App\Observers\UserObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // New User Signup Notification and User Model Observer 
        User::observe(UserObserver::class);
    }
}
