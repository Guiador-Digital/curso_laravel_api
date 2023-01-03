<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\User;
use App\Policies\ClientePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        User::class => UserPolicy::class,
        Cliente::class => ClientePolicy::class
    ];

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
        Schema::defaultStringLength(191);

        $this->registerPolicies();
    }
}
