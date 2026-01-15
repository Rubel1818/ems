<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // সব ভিউতে $allDesignations ভেরিয়েবলটি পাঠিয়ে দিন
        view()->share('allDesignations', \App\Models\StuffDesignation::all());
        Paginator::useBootstrapFive();
    }
}
