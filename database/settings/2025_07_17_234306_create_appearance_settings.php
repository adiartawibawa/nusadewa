<?php

use App\Settings\AppearanceSettings;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $defaults = AppearanceSettings::defaults();

        $this->migrator->add('appearance.sections', $defaults['sections']);
    }
};
