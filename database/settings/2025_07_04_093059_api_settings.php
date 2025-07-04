<?php

use App\Settings\ApiSettings;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('api.api_configurations', ApiSettings::defaults()['api_configurations']);
    }

    public function down(): void
    {
        $this->migrator->delete('api.api_configurations');
    }
};
