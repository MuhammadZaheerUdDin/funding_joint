<?php

namespace App\Providers;


use Illuminate\Contracts\Auth\Access\Gate as GateContract;

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
     * @param $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {

        $this->registerPolicies();

        //...
        $gate->define('laravel-inline-editor', function ($user) {

            $role = $user->getRole();


            if(strtolower($role) == "admin"){
                return true;
            }
        });
    }
}
