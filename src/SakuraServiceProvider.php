<?php

namespace Maddlen\Sakura;

use Illuminate\Support\ServiceProvider;
use Maddlen\Sakura\Commands\Init;
use Maddlen\Sakura\Commands\PushConfigVars;
use Maddlen\Sakura\Services\HerokuApp;
use Maddlen\Sakura\Services\Procfile;

class SakuraServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Init::class,
                PushConfigVars::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'sakura');
        $config = $this->app->make('config');
        $config->set('sakura.heroku_app_name', HerokuApp::name());

        $this->app->singleton('sakura', function () {
            return new Sakura();
        });
    }
}
