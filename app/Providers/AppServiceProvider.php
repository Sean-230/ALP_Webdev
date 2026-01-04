<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            
            // Fix session cookie domain for Railway
            config(['session.domain' => parse_url(config('app.url'), PHP_URL_HOST)]);
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
