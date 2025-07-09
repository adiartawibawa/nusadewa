<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\ApiSettings;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;

class ApiSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static string $view = 'filament.clusters.settings.pages.api-settings-page';

    protected static ?string $navigationLabel = 'API Integrations';

    protected static ?string $navigationGroup = 'APIs Settings';

    protected static ?int $navigationSort = 4;

    protected static ?string $cluster = Settings::class;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(ApiSettings::class);
        $configs = $settings->api_configurations ?? [];

        // Transform dari format {'order': {...}} ke array untuk Repeater
        $repeaterData = [];
        foreach ($configs as $key => $config) {
            $config['key'] = $key; // Tambahkan key ke dalam config
            $repeaterData[] = $config;
        }

        $this->form->fill([
            'api_configurations' => $repeaterData
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('api_configurations')
                    ->label('API Configurations')
                    ->schema([
                        TextInput::make('key')
                            ->label('API Key')
                            ->required()
                            ->default('order')
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull()
                            ->disabled(fn($operation) => $operation === 'edit'),

                        TextInput::make('name')
                            ->label('API Name')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('url')
                            ->label('Endpoint URL')
                            ->required()
                            ->url()
                            ->columnSpanFull(),

                        Select::make('method')
                            ->options([
                                'GET' => 'GET',
                                'POST' => 'POST',
                                'PUT' => 'PUT',
                                'PATCH' => 'PATCH',
                                'DELETE' => 'DELETE'
                            ])
                            ->default('GET')
                            ->required(),

                        Select::make('auth_type')
                            ->label('Authentication Type')
                            ->options([
                                'none' => 'None',
                                'bearer' => 'Bearer Token',
                                'basic' => 'Basic Auth',
                                'oauth2' => 'OAuth 2.0'
                            ])
                            ->live()
                            ->required(),

                        TextInput::make('auth_credentials')
                            ->label('Auth Credentials')
                            ->helperText(function (Get $get) {
                                return match ($get('auth_type')) {
                                    'bearer' => 'Enter bearer token',
                                    'basic' => 'Enter "username:password"',
                                    'oauth2' => 'Enter OAuth2 client credentials',
                                    default => ''
                                };
                            })
                            ->hidden(fn(Get $get) => $get('auth_type') === 'none'),

                        TextInput::make('api_key')
                            ->label('API Key (Optional)')
                            ->password(),

                        TextInput::make('timeout')
                            ->label('Timeout (seconds)')
                            ->numeric()
                            ->minValue(5)
                            ->maxValue(300)
                            ->default(30),

                        Toggle::make('verify_ssl')
                            ->label('Verify SSL Certificate')
                            ->default(true),

                        Toggle::make('active')
                            ->label('Active')
                            ->default(true),

                        KeyValue::make('headers')
                            ->label('Custom Headers')
                            ->keyLabel('Header Name')
                            ->valueLabel('Header Value')
                            ->columnSpanFull(),

                        Placeholder::make('last_status')
                            ->label('Last Status')
                            ->content(fn(Get $get) => match ($get('last_status')) {
                                'success' => '✅ Success',
                                'failed' => '❌ Failed',
                                default => 'Not tested',
                            }),

                        Placeholder::make('last_message')
                            ->label('Last Message')
                            ->content(fn(Get $get) => $get('last_message') ?? '-')
                            ->extraAttributes(['class' => 'font-mono text-sm']),

                        Placeholder::make('last_checked')
                            ->label('Last Checked')
                            ->content(fn(Get $get) => $get('last_checked') ? Carbon::parse($get('last_checked'))->diffForHumans() : '-'),
                    ])
                    ->columns(2)
                    ->itemLabel(fn(array $state): string => $state['name'] ?? 'New API')
                    ->collapsible()
                    ->cloneable()
                    ->deletable(true)
                    ->addActionLabel('Add New API')
                    ->defaultItems(1)
                    ->extraItemActions([
                        FormAction::make('test_connection')
                            ->label('Test Connection')
                            ->icon('heroicon-o-wifi')
                            ->color('gray')
                            ->action(function (array $arguments, Repeater $component) {
                                $state = $component->getState();
                                $index = $arguments['item'];

                                if (!isset($state[$index])) {
                                    Notification::make()
                                        ->title('Error')
                                        ->body('Invalid configuration index')
                                        ->danger()
                                        ->send();
                                    return;
                                }

                                $config = $state[$index];
                                $this->testSingleApiConnection($config, $index, $component);
                            })
                    ])

            ])
            ->statePath('data');
    }

    public function save(bool $silent = false): void
    {
        try {
            $data = $this->form->getState();

            // Transform array Repeater ke format yang diinginkan
            $transformedConfigs = [];
            foreach ($data['api_configurations'] as $config) {
                if (!empty($config['key'])) {
                    $key = $config['key'];
                    unset($config['key']); // Hapus field key dari config
                    $transformedConfigs[$key] = $config;
                }
            }

            $settings = app(ApiSettings::class);
            $settings->api_configurations = $transformedConfigs;
            $settings->save();

            if (!$silent) {
                Notification::make()
                    ->title('API Configurations Saved')
                    ->body('All API settings updated successfully')
                    ->success()
                    ->send();
            }
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body($e->getMessage())
                ->danger()
                ->send();

            report($e);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save All Configurations')
                ->action('save')
                ->color('primary')
                ->icon('heroicon-o-cloud-arrow-up'),
        ];
    }

    public function testSingleApiConnection(array $apiConfig, string $index, Repeater $component): void
    {
        $status = 'failed';
        $message = null;
        $timestamp = now()->toDateTimeString();

        try {
            if (empty($apiConfig['active'])) {
                throw new \Exception("API '{$apiConfig['name']}' is disabled.");
            }

            if (empty($apiConfig['url'])) {
                throw new \Exception('API URL is missing.');
            }

            $method = strtoupper($apiConfig['method'] ?? 'GET');
            $testMethod = $method === 'GET' ? 'HEAD' : $method;
            $timeout = (int)($apiConfig['timeout'] ?? 10);

            $headers = $apiConfig['headers'] ?? [];

            // Handle authentication
            if (!empty($apiConfig['auth_type']) && $apiConfig['auth_type'] !== 'none') {
                switch ($apiConfig['auth_type']) {
                    case 'bearer':
                        if (empty($apiConfig['auth_credentials'])) {
                            throw new \Exception('Bearer token is missing');
                        }
                        $headers['Authorization'] = 'Bearer ' . $apiConfig['auth_credentials'];
                        break;
                    case 'basic':
                        if (empty($apiConfig['auth_credentials'])) {
                            throw new \Exception('Basic auth credentials are missing');
                        }
                        $headers['Authorization'] = 'Basic ' . base64_encode($apiConfig['auth_credentials']);
                        break;
                }
            }

            // Optional API Key
            if (!empty($apiConfig['api_key'])) {
                $headers['X-API-Key'] = $apiConfig['api_key'];
            }

            $response = Http::withHeaders($headers)
                ->timeout($timeout)
                ->withOptions(['verify' => (bool)($apiConfig['verify_ssl'] ?? true)])
                ->send($testMethod, $apiConfig['url']);

            $status = $response->successful() ? 'success' : 'failed';
            $message = $response->successful()
                ? "Connected successfully to {$apiConfig['url']}"
                : "API returned status: {$response->status()}";
        } catch (\Throwable $e) {
            $message = $e->getMessage();
            report($e);
        }

        // Update item state pada index terkait
        $state = $component->getState();

        if (isset($state[$index])) {
            $state[$index]['last_status'] = $status;
            $state[$index]['last_message'] = $message;
            $state[$index]['last_checked'] = $timestamp;

            $component->state($state); // Simpan ulang ke form state

            // Simpan ke database
            $this->data['api_configurations'] = $state;
            $this->save(true);
        }

        Notification::make()
            ->title($status === 'success' ? 'Connection Successful' : 'Connection Failed')
            ->body($message)
            ->{$status === 'success' ? 'success' : 'danger'}()
            ->send();
    }
}
