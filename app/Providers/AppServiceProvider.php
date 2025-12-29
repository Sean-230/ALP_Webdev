<?php

namespace App\Providers;

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
        // Share data with all views
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $pendingApplication = \App\Models\ManagerApplication::where('user_id', auth()->id())
                    ->where('status', 'pending')
                    ->first();
                $view->with('userPendingApplication', $pendingApplication);
            }
        });
    }
}
