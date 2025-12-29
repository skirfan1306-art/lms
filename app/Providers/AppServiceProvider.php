<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Models\Category;
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
        if (app()->environment('local')) {
            if (Schema::hasTable('sitesettings')) {
                $settings = SiteSetting::first();
            } else {
                $settings = null;
            }
        } else {
            $settings = cache()->rememberForever('site_settings', fn () => SiteSetting::first());
        }
    
        View::share('gs', $settings);
        
        if (Schema::hasTable('notifications')) {
            $notifications = \App\Models\Notification::latest('id')->take(10)->get();
            $notificationCount = \App\Models\Notification::where('seen', 0)->count();
        
            View::share('adminNotify', $notifications);
            View::share('notifyCount', $notificationCount);
        }
        
        View::composer('*', function ($view) {
            $headerCategories = Category::with(['subcategory' => function($query){
                    $query->where('status', 1)->where('show_in_header', '1');
                }])
                ->where('status', 1)->where('show_in_header', '1')->get();
    
            $view->with('headerCategories', $headerCategories);
        });


    }


}
