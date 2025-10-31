<?php

namespace App\Providers;

use App\Models\SiteSetting;
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
        if (Schema::hasTable('sitesettings')) {
            $settings = SiteSetting::first();
            View::share('gs', $settings);
        }
        if (Schema::hasTable('notifications')) {
            $notifications = \App\Models\Notification::latest('id')->take(10)->get();
            $notificationCount = \App\Models\Notification::where('seen', 0)->count();
        
            View::share('adminNotify', $notifications);
            View::share('notifyCount', $notificationCount);
        }


    }


}
