<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        // Share site settings with all views
        if (Schema::hasTable('settings')) {
            $siteSettings = [
                'site_name' => Setting::get('site_name', config('app.name', 'Laravel')),
                'site_logo' => Setting::get('site_logo'),
            ];
            View::share('siteSettings', $siteSettings);
        }
    }
}
