<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('includes.header', function($view) {
            $view->with('current', preg_replace('/\..*/', '', Route::currentRouteName()));
        });
        view()->composer('includes.header_employee', function($view) {
            $view->with('current', preg_replace('/\..*/', '', Route::currentRouteName()));
        });
    }
}
