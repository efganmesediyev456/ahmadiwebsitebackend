<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {

            if (Schema::hasTable('languages')) {
                $languages = Language::get();
                view()->share('languages', $languages);
            }


        } catch (\Exception $e) {

        }


        Passport::enablePasswordGrant();
    }
}
