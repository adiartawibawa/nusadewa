<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\AppearanceSettings;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\DB;

class AppearanceSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Appearance Settings';

    protected static ?string $navigationGroup = 'Application Settings';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.clusters.settings.pages.appearance-settings-page';

    protected static ?string $cluster = Settings::class;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(AppearanceSettings::class);
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Appearance Configuration')
                    ->description('Customize the visual elements of your application sections')
                    ->icon('heroicon-o-cog')
                    ->collapsible()
                    ->schema([
                        Repeater::make('sections')
                            ->label('Page Sections')
                            ->addActionLabel('Add New Section')
                            ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Section Name')
                                    ->required()
                                    ->maxLength(100)
                                    ->readOnly()
                                    ->columnSpanFull(),

                                FileUpload::make('image')
                                    ->label('Featured Image')
                                    ->directory('settings/appearance')
                                    ->image()
                                    ->imageEditor()
                                    ->imagePreviewHeight('150')
                                    ->panelAspectRatio('2:1')
                                    ->panelLayout('integrated')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('right')
                                    ->uploadProgressIndicatorPosition('right')
                                    ->preserveFilenames()
                                    ->maxSize(2048)
                                    ->columnSpanFull(),

                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->columnSpanFull()
                                    ->helperText('Brief description for this section (max 500 characters)'),
                            ])
                            ->defaultItems(1)
                            ->minItems(1)
                            ->deletable(false)
                            ->collapsible()
                            ->collapsed(true)
                            ->addable(false)
                            ->grid(1)
                            ->columns(1),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->icon('heroicon-o-check-circle')
                ->action('save')
                ->color('primary')
                ->size('md')
                ->outlined(),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            DB::transaction(function () use ($data) {
                $settings = app(AppearanceSettings::class);
                $settings->fill($data);
                $settings->save();
            });

            Notification::make()
                ->title('Settings Saved')
                ->body('Your appearance settings have been updated successfully.')
                ->success()
                ->duration(5000)
                ->send();
        } catch (Halt $exception) {
            return;
        } catch (\Throwable $e) {
            report($e);

            Notification::make()
                ->title('Error Saving Settings')
                ->body('An error occurred while saving your changes. Please try again.')
                ->danger()
                ->duration(5000)
                ->send();
        }
    }
}
