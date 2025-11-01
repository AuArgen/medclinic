<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('view-users', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('edit-users', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-departments', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-settings', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-schedules', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-appointments', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('view-medic-appointments', function (User $user) {
            return $user->role === 'medic';
        });

        Gate::define('view-reports', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-buildings', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-floors', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-rooms', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
