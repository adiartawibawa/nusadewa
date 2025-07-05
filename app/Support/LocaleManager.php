<?php

namespace App\Support;

use App\Settings\SystemSettings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleManager
{
    public static function set()
    {
        $settings = app(SystemSettings::class);
        $locale = Session::get('locale') ?? $settings->default_language ?? config('app.locale');
        App::setLocale($locale);
    }
}
