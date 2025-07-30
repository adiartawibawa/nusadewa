<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\AppInfoSettings;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class AppInfoSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static string $view = 'filament.clusters.settings.pages.app-info-settings-page';

    protected static ?string $cluster = Settings::class;

    protected static ?string $navigationLabel = 'Company Information';

    protected static ?string $navigationGroup = 'Application Settings';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(AppInfoSettings::class);
        $data = $settings->toArray();

        if (isset($data['operational_hours']) && is_array($data['operational_hours'])) {
            $operationalHours = [];

            foreach ($data['operational_hours'] as $day => $times) {
                $isClosed = $times[0] === 'Closed' || $times[1] === 'Closed';
                $operationalHours[] = [
                    'day' => $day,
                    'closed' => $isClosed,
                    'open' => $isClosed ? null : $times[0],
                    'close' => $isClosed ? null : $times[1],
                ];
            }

            $data['operational_hours'] = $operationalHours;
        }

        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Company Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('company_name')
                            ->required()
                            ->maxLength(255),

                        FileUpload::make('company_logo')
                            ->image()
                            ->directory('settings/company')
                            ->preserveFilenames()
                            ->maxSize(2048),

                        Textarea::make('company_description')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('address')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('city')
                            ->required(),

                        TextInput::make('province')
                            ->required(),

                        TextInput::make('postal_code')
                            ->required(),

                        TextInput::make('country')
                            ->required(),
                    ]),

                Section::make('Contact Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('phone')
                            ->tel()
                            ->required(),
                    ]),

                Section::make('Operational Hours')
                    ->schema([
                        Repeater::make('operational_hours')
                            ->schema([
                                Select::make('day')
                                    ->options([
                                        'monday' => 'Monday',
                                        'tuesday' => 'Tuesday',
                                        'wednesday' => 'Wednesday',
                                        'thursday' => 'Thursday',
                                        'friday' => 'Friday',
                                        'saturday' => 'Saturday',
                                        'sunday' => 'Sunday',
                                    ])
                                    ->required(),

                                Toggle::make('closed')
                                    ->label('Closed')
                                    ->reactive(),

                                TimePicker::make('open')
                                    ->seconds(false)
                                    ->label('Open')
                                    ->visible(fn($get) => !$get('closed')),

                                TimePicker::make('close')
                                    ->seconds(false)
                                    ->label('Close')
                                    ->visible(fn($get) => !$get('closed')),
                            ])
                            ->columns(4)
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->defaultItems(7),
                    ]),
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
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            if (isset($data['operational_hours']) && is_array($data['operational_hours'])) {

                $formattedHours = [];
                foreach ($data['operational_hours'] as $item) {
                    $formattedHours[$item['day']] = $item['closed']
                        ? ['Closed', 'Closed']
                        : [$item['open'], $item['close']];
                }

                $data['operational_hours'] = $formattedHours;
            }

            DB::transaction(function () use ($data) {
                $settings = app(AppInfoSettings::class);
                $settings->fill($data);
                $settings->save();
            });

            Notification::make()
                ->title('Settings Saved')
                ->body('Company information updated successfully')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body($e->getMessage())
                ->danger()
                ->send();

            report($e);
        }
    }
}
