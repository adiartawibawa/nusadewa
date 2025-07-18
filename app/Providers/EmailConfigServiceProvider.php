<?php

namespace App\Providers;

use App\Settings\EmailSettings;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class EmailConfigServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(EmailSettings::class, function ($app) {
            return $app->make(EmailSettings::class)->toMailConfig();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides()
    {
        return ['email.config'];
    }
}
