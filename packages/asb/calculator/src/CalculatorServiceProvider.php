<?php

namespace Arunbalaji\calculator;

use Illuminate\Support\ServiceProvider;

class CalculatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('ArunBalaji\calculator\App\Http\Controllers\CalculatorController');
        $this->loadViewsFrom(__DIR__.'/resources/views','calci');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        
    }
}
