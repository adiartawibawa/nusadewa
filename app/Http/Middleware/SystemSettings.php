<?php

namespace App\Http\Middleware;

use App\Settings\SystemSettings as SettingsSystemSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = app(SettingsSystemSettings::class);

        // Set Language
        if ($settings->default_language) {
            app()->setLocale($settings->default_language);
            setlocale(LC_TIME, $settings->default_language);
        }

        // Set Timezone
        if ($settings->timezone) {
            config(['app.timezone' => $settings->timezone]);
            date_default_timezone_set($settings->timezone);
        }


        return $next($request);
    }
}
