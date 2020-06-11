<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function($view){
            $view_name = str_replace(".", "-", $view->getName());
            $view = explode("-", $view_name);
            array_shift($view);
            $view_name = implode("-", $view);
            view()->share('view_name', $view_name);
        });
    }
}
