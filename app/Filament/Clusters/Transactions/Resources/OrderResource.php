<?php

namespace App\Filament\Clusters\Transactions\Resources;

use App\Filament\Clusters\Transactions;
use App\Filament\Clusters\Transactions\Resources\OrderResource\Pages;
use App\Filament\Clusters\Transactions\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Settings\ApiSettings;
use Filament\Actions\Action;
use Filament\Actions\StaticAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Orders';

    protected static ?string $cluster = Transactions::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('commodity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sub_commodity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->maxLength(50),
                Forms\Components\DateTimePicker::make('delivery_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commodity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_commodity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit'),
                Tables\Columns\TextColumn::make('delivery_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('fetchOrders')
                    ->label('Fetch Orders from API')
                    ->icon('heroicon-o-cloud-arrow-down')
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Order Fetch')
                    ->modalDescription('Are you sure you want to fetch orders from the API? This may take several minutes.')
                    ->modalSubmitActionLabel('Yes, Fetch Orders')
                    ->action(function () {
                        static::fetchOrders();
                    })
                    ->modalCancelAction(fn(StaticAction $action) => $action->label('Cancel'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function fetchOrders(): void
    {
        try {
            $apiSettings = app(ApiSettings::class);
            $orderApi = $apiSettings->getApiConfig('order');

            if (!$orderApi || empty($orderApi['active'])) {
                Notification::make()
                    ->title('Order API Error')
                    ->body('Order API is not configured or disabled. Please configure it first.')
                    ->danger()
                    ->actions([
                        Action::make('Go to API Settings')
                            ->button()
                            ->url(route('filament.admin.settings.pages.api-settings-page'), shouldOpenInNewTab: true)
                    ])
                    ->send();

                return;
            }

            $response = Http::withHeaders($apiSettings->getPreparedHeaders('order'))
                ->timeout($orderApi['timeout'] ?? 10)
                ->{$orderApi['method']}($orderApi['url']);

            if (!$response->successful()) {
                self::notify('API Error', 'Failed to fetch orders from API.', 'danger');
                return;
            }

            $orders = $response->json() ?? [];
            $importedCount = self::importOrders($orders);

            self::notify('Orders Fetched', "Successfully imported {$importedCount} new orders.", 'success');
        } catch (\Throwable $e) {
            self::notify('Unexpected Error', $e->getMessage(), 'danger');
            report($e);
        }
    }

    private static function importOrders(array $orders): int
    {
        $imported = 0;

        foreach ($orders as $data) {
            if (self::isDuplicateOrder($data)) {
                continue;
            }

            Order::create([
                'customer_name'   => $data['nama'],
                'commodity'       => $data['nama_komoditi'],
                'sub_commodity'   => $data['nama_sub_komoditi'],
                'quantity'        => $data['jumlah'],
                'unit'            => $data['satuan'],
                'delivery_date'   => $data['tanggal_kirim'],
                'external_id'     => md5($data['nama'] . $data['tanggal_kirim']),
            ]);

            $imported++;
        }

        return $imported;
    }

    private static function isDuplicateOrder(array $data): bool
    {
        return Order::where([
            'customer_name' => $data['nama'],
            'delivery_date' => $data['tanggal_kirim'],
        ])->exists();
    }

    private static function notify(string $title, string $body, string $type = 'info'): void
    {
        Notification::make()
            ->title($title)
            ->body($body)
            ->{$type}()
            ->send();
    }
}
