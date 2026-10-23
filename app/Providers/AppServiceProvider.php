<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::share('errors', new ViewErrorBag());

        try {
            if (Schema::hasTable('settings')) {
                $settings = Setting::pluck('value', 'key')->toArray();
                View::share('globalSettings', $settings);
            }
        } catch (\Exception $e) {
            // Ignore during migrations
        }
    }
}
