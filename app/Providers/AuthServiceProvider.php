<?php

namespace App\Providers;

use Laravel\Passport\Passport;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Gate::define('users.create', function ($user) {
            return $user->is_admin;
        });

        Gate::define('plans.create', function ($user) {
            return $user->hasRole('plan') || $user->hasRole('admin');
        });

        Gate::define('add.pricing', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('add.addons', function ($user) {
            return $user->hasRole('addons') || $user->hasRole('admin');
        });

        Gate::define('share', function ($user, $sharable) {
            return $sharable->owner_id = $user->id;
        });
    }
}
