<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            
            // Trust all proxies (required for Railway)
            request()->server->set('HTTPS', 'on');
        }

        // Share data with all views
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $pendingApplication = \App\Models\ManagerApplication::where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->first();
                $view->with('userPendingApplication', $pendingApplication);
            }
        });
    }
}
