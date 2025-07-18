<?php

namespace App\Providers;

use App\View\Components\NusaDewaLayout;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        $layoutComponent = app(NusaDewaLayout::class);

        View::composer('*', function ($view) use ($layoutComponent) {
            $view->with(
                [
                    'appInfo' => $layoutComponent->getPublicAppInfo(),
                    'systemInfo' => $layoutComponent->getPublicSystemInfo(),
                    'socialMedia' => $layoutComponent->getSocialMediaInfo(),
                    'seo' => $layoutComponent->getSeoInfo(),
                    'appearance' => $layoutComponent->getAppearanceSetting(),
                ]
            );
        });
    }
}
