<?php

namespace App\Providers;

use App\Settings\EmailSettings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class EmailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Ambil pengaturan dari database
        $emailSettings = app(EmailSettings::class);

        // Update konfigurasi Laravel
        Config::set('mail', $emailSettings->toMailConfig());
    }
}
