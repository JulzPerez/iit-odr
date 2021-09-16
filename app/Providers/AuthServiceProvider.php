<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //GAtes
        Gate::define('isAdmin',function($user){
            return $user->user_type === 'admin';
        });

        Gate::define('isStaff',function($user){
            return $user->user_type === 'staff';
        });

        Gate::define('isRequester',function($user){
            return $user->user_type === 'requester';
        });

        Gate::define('isWindowStaff',function($user){
            return $user->user_type === 'window staff';
        });

        Gate::define('isOtherStaff',function($user){
            return $user->user_type === 'other staff';
        });
    }
}
