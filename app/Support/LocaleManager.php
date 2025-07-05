<?php

namespace App\Support;

use App\Settings\SystemSettings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LocaleManager
{
    /**
     * Set aplikasi locale berdasarkan session, default setting, atau fallback app.locale.
     * - Frontend: berdasarkan URL prefix
     * - Backend: berdasarkan session
     */
    public static function set()
    {
        $settings = app(SystemSettings::class);
        $supported = $settings->supported_languages ?? [];
        $default = $settings->default_language ?? config('app.locale');

        // Tentukan apakah sedang di backend atau frontend
        $isBackend = str_starts_with(Request::path(), 'admin');

        if ($isBackend) {
            $locale = Session::get('locale', $default);
        } else {
            $urlLocale = Request::segment(1);
            $locale = in_array($urlLocale, $supported) ? $urlLocale : $default;

            Session::put('locale', $locale);
        }

        App::setLocale($locale);
    }

    /**
     * Dapatkan daftar supported locales dengan default di urutan pertama.
     */
    public static function getSupportedLocales(): array
    {
        $settings = app(SystemSettings::class);

        $default = $settings->default_language ?? config('app.locale');
        $supported = $settings->supported_languages ?? [];

        // Gabungkan default di depan, hilangkan duplikat
        return array_values(array_unique(array_merge([$default], $supported)));
    }

    function localized_route($name, $parameters = [], $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $parameters = array_merge(['locale' => $locale], $parameters);
        return route($name, $parameters);
    }
}
