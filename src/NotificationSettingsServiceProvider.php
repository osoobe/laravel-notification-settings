<?php

namespace Osoobe\NotificationSettings;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use NotificationSetting;

class NotificationSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('notification-settings', function() {
            return new NotificationSetting;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
