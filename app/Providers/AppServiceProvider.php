<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(Authenticated::class, function ($event) {
            session()->put('last_auth_check', now());
        });

        Gate::define('view-exclusive-page', function (User $user) {
            $pagerole = ['teacher', 'admin', 'superadmin'];
            
            return in_array($user->role, $pagerole);
        });
    }
}
