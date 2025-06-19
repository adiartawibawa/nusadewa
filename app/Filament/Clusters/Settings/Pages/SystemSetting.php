<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\SystemSettings;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.clusters.settings.pages.system-setting';

    protected static ?string $cluster = Settings::class;

    protected static ?string $navigationLabel = 'System Settings';

    protected static ?string $navigationGroup = 'System Configuration';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(SystemSettings::class);
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Tab General Settings
                Section::make('General Settings')
                    ->schema([
                        TagsInput::make('supported_languages')
                            ->label('Supported Languages')
                            ->placeholder('Add language code')
                            ->required(),

                        Select::make('default_language')
                            ->options(array_combine(
                                $this->data['supported_languages'] ?? ['id', 'en'],
                                array_map('ucfirst', $this->data['supported_languages'] ?? ['id', 'en'])
                            ))
                            ->required(),

                        Toggle::make('maintenance_mode')
                            ->label('Maintenance Mode'),

                        Select::make('timezone')
                            ->options(timezone_identifiers_list())
                            ->searchable()
                            ->required(),

                        TextInput::make('date_format')
                            ->required(),

                        TextInput::make('time_format')
                            ->required(),
                    ])->columns(2),

                // Tab SEO Settings
                Section::make('SEO Settings')
                    ->schema([
                        TextInput::make('site_name')
                            ->required(),

                        Textarea::make('site_description'),

                        TextInput::make('site_keywords')
                            ->label('Meta Keywords'),

                        TextInput::make('site_author'),

                        TextInput::make('canonical_url')
                            ->url(),

                        Textarea::make('robots_txt')
                            ->rows(5),

                        Toggle::make('enable_sitemap'),

                        Toggle::make('enable_google_analytics')
                            ->live(),

                        TextInput::make('google_analytics_id')
                            ->visible(fn($get) => $get('enable_google_analytics')),

                        TextInput::make('google_tag_manager_id'),
                    ])->columns(2),

                // Tab Unsplash Settings
                Section::make('Unsplash Settings')
                    ->schema([
                        Toggle::make('unsplash_enabled')
                            ->live(),

                        TextInput::make('unsplash_api_key')
                            ->password()
                            ->visible(fn($get) => $get('unsplash_enabled')),

                        TagsInput::make('unsplash_default_search_terms')
                            ->visible(fn($get) => $get('unsplash_enabled')),

                        Select::make('unsplash_image_quality')
                            ->options([
                                'raw' => 'Raw',
                                'full' => 'Full',
                                'regular' => 'Regular',
                                'small' => 'Small',
                                'thumb' => 'Thumbnail',
                            ])
                            ->visible(fn($get) => $get('unsplash_enabled')),

                        Toggle::make('unsplash_auto_attribution')
                            ->visible(fn($get) => $get('unsplash_enabled')),
                    ])->columns(2),

                // Tab Landing Page Settings
                // Section::make('Landing Page Settings')
                //     ->schema([
                //         TagsInput::make('landing_page_sections')
                //             ->label('Enabled Sections'),

                //         ColorPicker::make('landing_primary_color')
                //             ->hex(),

                //         ColorPicker::make('landing_secondary_color')
                //             ->hex(),

                //         Toggle::make('landing_show_testimonials'),

                //         Toggle::make('landing_show_featured_products'),
                //     ])->columns(2),

                // Tab Product Settings
                // Section::make('Product Settings')
                //     ->schema([
                //         TextInput::make('product_currency')
                //             ->required(),

                //         TextInput::make('product_currency_symbol')
                //             ->required(),

                //         Toggle::make('product_show_prices'),

                //         Toggle::make('product_enable_reviews'),

                //         Toggle::make('product_enable_stock_management'),
                //     ])->columns(2),

                // Tab Team Settings
                // Section::make('Team Settings')
                //     ->schema([
                //         Toggle::make('team_enabled')
                //             ->live(),

                //         Select::make('team_layout')
                //             ->options([
                //                 'grid' => 'Grid',
                //                 'list' => 'List',
                //                 'carousel' => 'Carousel',
                //             ])
                //             ->visible(fn($get) => $get('team_enabled')),

                //         Toggle::make('team_show_social_links')
                //             ->visible(fn($get) => $get('team_enabled')),

                //         TagsInput::make('team_social_platforms')
                //             ->visible(fn($get) => $get('team_enabled')),
                //     ])->columns(2),

                // Tab Social Media Links
                Section::make('Social Media Links')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->url(),

                        TextInput::make('twitter_url')
                            ->url(),

                        TextInput::make('instagram_url')
                            ->url(),

                        TextInput::make('linkedin_url')
                            ->url(),

                        TextInput::make('youtube_url')
                            ->url(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->action('save')
                ->color('primary'),

            Action::make('clear_cache')
                ->label('Clear Cache')
                ->color('gray')
                ->action('clearCache')
                ->requiresConfirmation(),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $settings = app(SystemSettings::class);
            $settings->fill($data);
            $settings->save();

            Cache::forget('system-settings');

            Notification::make()
                ->title('System settings saved successfully')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Failed to save system settings')
                ->body($e->getMessage())
                ->danger()
                ->send();

            logger()->error('System settings save failed: ' . $e->getMessage(), [
                'exception' => $e,
                'settings_data' => $this->data
            ]);
        }
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->submit('save')
                ->color('primary'),

            Action::make('clear_cache')
                ->label('Clear Cache')
                ->color('gray')
                ->action('clearCache')
                ->requiresConfirmation(),
        ];
    }

    public function clearCache(): void
    {
        Cache::flush();

        Notification::make()
            ->title('Cache cleared successfully')
            ->success()
            ->send();
    }
}
