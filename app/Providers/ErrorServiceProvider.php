<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ErrorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('ErrorType', function(){
            return new \ErrorType;
        });
    }
}
