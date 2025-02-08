<?php

namespace App\Providers;

// use Illuminate\Contracts\Pagination\Paginator;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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
        Paginator::useBootstrap();

        Gate::define('admin',function (User $user) {
            return $user->is_admin;
        });

        Gate::define('user',function (User $user) {
            return !$user->is_admin;
        });

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
}