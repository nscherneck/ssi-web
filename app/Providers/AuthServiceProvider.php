<?php

namespace App\Providers;

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
        'App\Customer' => 'App\Policies\CustomerPolicy',
        'App\Site' => 'App\Policies\SitePolicy',
        'App\System' => 'App\Policies\SystemPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-dashboard', function ($user) {
            return $user->id == 1 || $user->id == 7;
        });
    }
}
