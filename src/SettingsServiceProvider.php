<?php

namespace Rennokki\Settings;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/eloquent-settings.php' => config_path('eloquent-settings.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/2018_05_19_135648_settings.php' => database_path('migrations/2018_05_19_135648_settings.php'),
            __DIR__.'/../database/migrations/2018_05_19_135649_settings_add_cast_type.php' => database_path('migrations/2018_05_19_135649_settings_add_cast_type.php'),
        ], 'migration');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
