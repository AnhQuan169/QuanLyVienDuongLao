<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('quanlytt', function ($user) {
            return $user->quyen == 0;
        });

        Gate::define('nhanvienkho', function ($user) {
            return $user->quyen == 1;
        });

        Gate::define('nhanvienyte', function ($user) {
            return $user->quyen == 2;
        });

        Gate::define('nguoithan', function ($user) {
            return $user->quyen == 3;
        });
    }
}
