<?php

namespace App\Providers\Filament;

use App\Http\Middleware\SetLocale;
use App\Settings\AppInfoSettings;
use App\Settings\SystemSettings;
use App\Support\LocaleManager;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName($this->getBrandName())
            ->favicon($this->getFavicon())
            ->colors([
                'primary' => Color::Sky,
            ])
            ->sidebarCollapsibleOnDesktop(true)
            ->sidebarFullyCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->unsavedChangesAlerts()
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales($this->getSupportedLocales()),
            ]);
    }

    protected function getBrandName(): string
    {
        try {
            if (Schema::hasTable('system_settings')) {
                return app(SystemSettings::class)->site_name ?? config('app.name');
            }
        } catch (\Exception $e) {
            Log::error('Failed to retrieve brand name: ' . $e->getMessage());
        }

        return config('app.name');
    }

    protected function getFavicon(): string
    {
        try {
            if (Schema::hasTable('app_info_settings')) {
                $logo = app(AppInfoSettings::class)->company_logo;
                if ($logo && Storage::exists($logo)) {
                    return Storage::url($logo);
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to retrieve favicon: ' . $e->getMessage());
        }

        return 'favicon.ico';
    }

    protected function getSupportedLocales(): array
    {
        try {
            if (Schema::hasTable('locales')) {
                return LocaleManager::getSupportedLocales();
            }
        } catch (\Exception $e) {
            Log::error('Failed to retrieve locales: ' . $e->getMessage());
        }

        return ['en'];
    }
}
